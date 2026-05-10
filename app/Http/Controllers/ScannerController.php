<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\{Produit, Scan, ScannerSession, StatistiqueEco};

class ScannerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $session = ScannerSession::where('utilisateur_id', $user->id)
            ->where('consomme', false)
            ->where('expires_at', '>', now())
            ->first();

        if (!$session) {
            $session = ScannerSession::create([
                'utilisateur_id' => $user->id,
                'token'          => Str::random(32),
                'expires_at'     => now()->addMinutes(10),
            ]);
        }

        return view('scanner.index', compact('session'));
    }

    public function mobileScanner($token)
    {
        $session = ScannerSession::where('token', $token)
            ->where('consomme', false)
            ->where('expires_at', '>', now())
            ->first();

        if (!$session) return view('scanner.mobile_expired');
        return view('scanner.mobile', compact('token', 'session'));
    }

    public function pollCode($token)
    {
        $session = ScannerSession::where('token', $token)
            ->where('consomme', false)
            ->where('expires_at', '>', now())
            ->first();

        if (!$session) return response()->json(['status' => 'expired']);
        if ($session->code_barre) {
            $session->update(['consomme' => true]);
            return response()->json([
                'status'     => 'ok',
                'code_barre' => $session->code_barre,
                'redirect'   => route('produits.show', $session->code_barre),
            ]);
        }
        return response()->json(['status' => 'waiting']);
    }

    public function sendCode(Request $request)
    {
        $request->validate([
            'token'      => 'required|string',
            'code_barre' => 'required|string',
        ]);

        $session = ScannerSession::where('token', $request->token)
            ->where('consomme', false)
            ->where('expires_at', '>', now())
            ->first();

        if (!$session) return response()->json(['error' => 'Session expirée.'], 422);
        $session->update(['code_barre' => $request->code_barre]);
        return response()->json(['status' => 'ok']);
    }

    public function scan(Request $request)
    {
        $request->validate(['code_barre' => 'required|string']);
        $code    = trim($request->code_barre);
        $produit = Produit::with('alternatives')->find($code);

        if (!$produit) {
            return redirect()->route('scanner.index')
                ->with('warning', "Produit \"$code\" non trouvé.");
        }

        Scan::create(['utilisateur_id' => Auth::id(), 'produit_id' => $code]);
        $this->mettreAJourStats(Auth::user(), $produit);

        return redirect()->route('produits.show', $code)
            ->with('success', 'Produit scanné !');
    }

    private function mettreAJourStats($user, $produit): void
    {
        $stat = StatistiqueEco::firstOrCreate(
            ['utilisateur_id' => $user->id, 'annee' => now()->year, 'mois' => now()->month],
            ['nb_scans' => 0, 'co2_economise' => 0, 'score_moyen' => 0]
        );
        $newScore = $stat->nb_scans > 0
            ? intval(($stat->score_moyen + $produit->score_eco) / 2)
            : $produit->score_eco;

        $stat->update([
            'nb_scans'      => $stat->nb_scans + 1,
            'co2_economise' => $stat->co2_economise + $produit->co2_kg,
            'score_moyen'   => $newScore,
        ]);
        $user->increment('co2_economise', $produit->co2_kg);
        $user->ajouterPoints(2);
    }
}
