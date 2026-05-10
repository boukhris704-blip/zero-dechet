<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\{Scan, Defi, StatistiqueEco, Client};

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $derniersScans = Scan::with('produit')
            ->where('utilisateur_id', $user->id)
            ->latest()->take(5)->get();

        $defisActifs = Defi::where('date_fin', '>', now())->take(3)->get();

        $statsMois = StatistiqueEco::where('utilisateur_id', $user->id)
            ->where('annee', now()->year)
            ->where('mois', now()->month)
            ->first();

        $badges    = $user->badges()->latest('user_badges.created_at')->take(3)->get();
        $classement = Client::orderByDesc('points')->take(5)->get();

        return view('dashboard.index', compact(
            'user','derniersScans','defisActifs','statsMois','badges','classement'
        ));
    }
}
