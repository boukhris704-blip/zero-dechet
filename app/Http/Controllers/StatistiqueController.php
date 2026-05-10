<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\{Scan, Produit, StatistiqueEco};
use App\Models\Client;

class StatistiqueController extends Controller
{
    public function index()
    {
        $totalScans    = Scan::count();
        $totalProduits = Produit::count();
        $totalUsers    = Client::where('is_admin', false)->count();
        $totalCo2      = Client::sum('co2_economise');

        $categories = DB::table('produits')
            ->select('categorie', DB::raw('AVG(score_eco) as score_moyen'))
            ->groupBy('categorie')
            ->get();

        $scansMois = DB::table('scans')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as mois'), DB::raw('COUNT(*) as total'))
            ->groupBy('mois')
            ->orderBy('mois')
            ->take(12)
            ->get();

        $topUsers = Client::where('is_admin', false)
            ->orderByDesc('points')
            ->take(5)
            ->get()
            ->map(fn($u) => ['nom' => $u->prenom . ' ' . $u->nom, 'points' => $u->points]);

        $co2Mois = DB::table('statistiques_eco')
            ->select(DB::raw('CONCAT(annee, "-", LPAD(mois, 2, "0")) as mois'), DB::raw('SUM(co2_economise) as total_co2'))
            ->groupBy('annee', 'mois')
            ->orderBy('annee')
            ->orderBy('mois')
            ->take(12)
            ->get();

        $pieCategories = DB::table('produits')
            ->select('categorie', DB::raw('COUNT(*) as total'))
            ->groupBy('categorie')
            ->get();

        return view('stats.index', compact(
            'totalScans', 'totalProduits', 'totalUsers', 'totalCo2',
            'categories', 'scansMois', 'topUsers', 'co2Mois', 'pieCategories'
        ));
    }
}
