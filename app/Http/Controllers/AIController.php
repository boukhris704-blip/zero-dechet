<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Scan;
use App\Models\StatistiqueEco;

class AIController extends Controller
{
    private function callAI(string $prompt): string
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
            'Content-Type' => 'application/json',
        ])->timeout(30)->post('https://api.groq.com/openai/v1/chat/completions', [
            'model' => 'llama-3.3-70b-versatile',
            'messages' => [['role' => 'user', 'content' => $prompt]],
            'max_tokens' => 1000,
            'temperature' => 0.7,
        ]);
        return $response->json()['choices'][0]['message']['content'] ?? 'Erreur IA';
    }

    public function chatbot(Request $request)
    {
        if ($request->isMethod('post')) {
            $question = $request->input('question');
            $reponse = $this->callAI(
                "Tu es un assistant écologique expert. Réponds en français de façon courte et claire à : $question"
            );
            return response()->json(['reponse' => $reponse]);
        }
        return view('ai.chatbot');
    }

    public function rapport()
    {
        $user = Auth::user();
        $scans = Scan::where('utilisateur_id', $user->id)
            ->with('produit')->latest()->take(20)->get();
        $listeProduits = $scans->map(fn($s) => $s->produit?->nom)->filter()->join(', ');
        $co2 = $user->co2_economise;
        $points = $user->points;

        $rapport = $this->callAI(
            "Génère un rapport écologique mensuel en français pour un utilisateur qui a :
            - Scanné ces produits : $listeProduits
            - Économisé $co2 kg de CO₂
            - Gagné $points points
            Donne une analyse, des conseils personnalisés et une note sur 10."
        );
        return view('ai.rapport', compact('rapport', 'user'));
    }

    public function defisPersonnalises()
    {
        $user = Auth::user();
        $scans = Scan::where('utilisateur_id', $user->id)
            ->with('produit')->latest()->take(10)->get();
        $listeProduits = $scans->map(fn($s) => $s->produit?->nom)->filter()->join(', ');

        $defisJson = $this->callAI(
            "Génère 3 défis écologiques personnalisés en JSON pour un utilisateur qui achète : $listeProduits.
            Format: [{\"titre\":\"...\",\"description\":\"...\",\"points_recompense\":50,\"duree_jours\":7}]
            Réponds UNIQUEMENT en JSON valide sans texte autour."
        );

        $defisJson = preg_replace('/```json|```/', '', $defisJson);
        $defis = json_decode(trim($defisJson), true) ?? [];
        return view('ai.defis', compact('defis'));
    }

    public function empreinte()
    {
        $user = Auth::user();
        $stats = StatistiqueEco::where('utilisateur_id', $user->id)->get();
        $totalCo2 = $stats->sum('co2_economise');
        $totalScans = $stats->sum('nb_scans');

        $analyse = $this->callAI(
            "Analyse l'empreinte carbone en français :
            - CO₂ économisé : $totalCo2 kg
            - Produits scannés : $totalScans
            Donne des comparaisons concrètes et des conseils."
        );
        return view('ai.empreinte', compact('analyse', 'totalCo2', 'totalScans', 'user'));
    }

    public function analyserProduit(Request $request)
    {
        $nom = $request->input('nom');
        $score = $request->input('score_eco');
        $categorie = $request->input('categorie');

        $analyse = $this->callAI(
            "Analyse ce produit en français :
            Nom: $nom, Catégorie: $categorie, Score écologique: $score/100
            Explique l'impact environnemental et donne 3 conseils."
        );
        return response()->json(['analyse' => $analyse]);
    }
}
