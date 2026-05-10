<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Produit;

class ProduitController extends Controller
{
    public function index(Request $request)
    {
        $query = Produit::query();
        if ($s = $request->get('search'))
            $query->where('nom','like',"%$s%")->orWhere('marque','like',"%$s%")->orWhere('codeBarres',$s);
        if ($c = $request->get('categorie')) $query->where('categorie', $c);
        $produits   = $query->orderByDesc('score_eco')->paginate(12);
        $categories = Produit::distinct()->pluck('categorie');
        return view('produits.index', compact('produits','categories'));
    }

    public function show(string $codeBarres)
    {
        $produit = Produit::find($codeBarres);

        // Produit non trouvé → formulaire
        if (!$produit) {
            return view('produits.inconnu', compact('codeBarres'));
        }

        $alternatives = DB::table('alternatives')->where('produit_id', $codeBarres)->get();

        // Pas d'alternatives → IA en génère
        if ($alternatives->isEmpty()) {
            $alternatives = $this->genererEtSauvegarderAlternatives($codeBarres, $produit->nom, $produit->categorie);
        }

        $similaires = Produit::where('categorie', $produit->categorie)
            ->where('codeBarres', '!=', $codeBarres)
            ->orderByDesc('score_eco')
            ->take(3)->get();

        $iaGenere = session('ia_genere_' . $codeBarres, false);

        return view('produits.show', compact('produit', 'alternatives', 'similaires', 'iaGenere'));
    }

    public function analyser(Request $request)
    {
        $codeBarres = $request->input('codeBarres');
        $nom        = $request->input('nom');
        $marque     = $request->input('marque', '');
        $categorie  = $request->input('categorie', 'Général');

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                'Content-Type'  => 'application/json',
            ])->timeout(30)->post('https://api.groq.com/openai/v1/chat/completions', [
                'model'    => 'llama-3.3-70b-versatile',
                'messages' => [[
                    'role'    => 'user',
                    'content' => "Analyse ce produit : Nom=$nom, Marque=$marque, Catégorie=$categorie.
                    Donne un score_eco (1-100) et co2_kg (decimal) réalistes.
                    JSON: {\"score_eco\":50,\"co2_kg\":0.5,\"description\":\"...\"}
                    UNIQUEMENT JSON valide."
                ]],
                'max_tokens' => 200,
            ]);

            $text = $response->json()['choices'][0]['message']['content'] ?? '';
            $text = preg_replace('/```json|```/', '', $text);
            $data = json_decode(trim($text), true);

            Produit::create([
                'codeBarres'  => $codeBarres,
                'nom'         => $nom,
                'marque'      => $marque,
                'categorie'   => $categorie,
                'score_eco'   => $data['score_eco'] ?? 50,
                'co2_kg'      => $data['co2_kg'] ?? 0.5,
                'description' => $data['description'] ?? 'Analysé par IA',
            ]);

            session(['ia_genere_' . $codeBarres => true]);

        } catch (\Exception $e) {
            Produit::create([
                'codeBarres' => $codeBarres,
                'nom'        => $nom,
                'marque'     => $marque,
                'categorie'  => $categorie,
                'score_eco'  => 50,
                'co2_kg'     => 0.5,
                'description'=> 'Produit ajouté manuellement',
            ]);
        }

        return redirect()->route('produits.show', $codeBarres);
    }

    private function genererEtSauvegarderAlternatives(string $codeBarres, string $nom, string $categorie)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                'Content-Type'  => 'application/json',
            ])->timeout(30)->post('https://api.groq.com/openai/v1/chat/completions', [
                'model'    => 'llama-3.3-70b-versatile',
                'messages' => [[
                    'role'    => 'user',
                    'content' => "Génère 3 alternatives écologiques pour '$nom' catégorie '$categorie'.
                    JSON: [{\"nom\":\"...\",\"score_eco\":90,\"lien\":\"https://example.com\"}]
                    UNIQUEMENT JSON valide."
                ]],
                'max_tokens' => 300,
            ]);

            $text = $response->json()['choices'][0]['message']['content'] ?? '';
            $text = preg_replace('/```json|```/', '', $text);
            $data = json_decode(trim($text), true);

            if (!$data) return collect([]);

            foreach ($data as $alt) {
                DB::table('alternatives')->insert([
                    'produit_id' => $codeBarres,
                    'nom'        => $alt['nom'] ?? 'Alternative',
                    'score_eco'  => $alt['score_eco'] ?? 80,
                    'lien'       => $alt['lien'] ?? '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return DB::table('alternatives')->where('produit_id', $codeBarres)->get();

        } catch (\Exception $e) {
            return collect([]);
        }
    }
}
