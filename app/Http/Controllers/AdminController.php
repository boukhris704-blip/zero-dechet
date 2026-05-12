<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Client, Produit, Defi, Badge, Scan};

class AdminController extends Controller
{
    public function dashboard()
    {
        $nbUsers          = Client::where('is_admin', false)->count();
        $nbProduits       = Produit::count();
        $nbDefis          = Defi::count();
        $nbScans          = Scan::count();
        $dernersUsers     = Client::where('is_admin', false)->latest()->take(5)->get();
        $derniersProduits = Produit::latest()->take(5)->get();
        return view('admin.dashboard', compact('nbUsers','nbProduits','nbDefis','nbScans','dernersUsers','derniersProduits'));
    }

    public function produits()
    {
        $produits = Produit::orderByDesc('created_at')->paginate(10);
        return view('admin.produits', compact('produits'));
    }

    public function storeProduit(Request $request)
    {
        $request->validate([
            'codeBarres' => 'required|unique:produits',
            'nom'        => 'required',
            'categorie'  => 'required',
            'score_eco'  => 'required|integer',
            'co2_kg'     => 'required|numeric',
        ]);
        Produit::create($request->all());
        return back()->with('success', 'Produit ajouté !');
    }

    public function deleteProduit(string $codeBarres)
    {
        Produit::findOrFail($codeBarres)->delete();
        return back()->with('success', 'Produit supprimé !');
    }

    public function defis()
    {
        $defis = Defi::orderByDesc('created_at')->get();
        return view('admin.defis', compact('defis'));
    }

    public function storeDefi(Request $request)
    {
        $request->validate([
            'titre'             => 'required',
            'description'       => 'required',
            'points_recompense' => 'required|integer',
            'date_fin'          => 'required|date',
        ]);
        Defi::create($request->all());
        return back()->with('success', 'Défi ajouté !');
    }

    public function users()
    {
        $users = Client::where('is_admin', false)->orderByDesc('points')->get();
        return view('admin.users', compact('users'));
    }

    public function deleteUser(int $id)
    {
        Client::findOrFail($id)->delete();
        return back()->with('success', 'Utilisateur supprimé !');
    }

    public function badges()
    {
        $badges = Badge::orderBy('points_requis')->get();
        return view('admin.badges', compact('badges'));
    }

    public function storeBadge(Request $request)
    {
        $request->validate([
            'nom'           => 'required',
            'points_requis' => 'required|integer',
        ]);
        Badge::create($request->all());
        return back()->with('success', 'Badge ajouté !');
    }
}
