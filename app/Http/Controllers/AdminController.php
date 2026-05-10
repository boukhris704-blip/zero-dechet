<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Produit,Scan,Defi,Client,Badge};

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard',['totalUsers'=>Client::where('is_admin',false)->count(),'totalProduits'=>Produit::count(),'totalScans'=>Scan::count(),'totalDefis'=>Defi::count()]);
    }
    public function produits(){return view('admin.produits',['produits'=>Produit::paginate(20)]);}
    public function storeProduit(Request $r){
        Produit::create($r->validate(['codeBarres'=>'required|string|unique:produits','nom'=>'required','marque'=>'nullable','categorie'=>'required','score_eco'=>'required|integer|min:0|max:100','co2_kg'=>'required|numeric','description'=>'nullable']));
        return back()->with('success','Produit ajouté.');
    }
    public function deleteProduit(string $c){Produit::findOrFail($c)->delete();return back()->with('success','Supprimé.');}
    public function defis(){return view('admin.defis',['defis'=>Defi::paginate(20)]);}
    public function storeDefi(Request $r){
        Defi::create($r->validate(['titre'=>'required','description'=>'required','points_recompense'=>'required|integer|min:1','date_fin'=>'required|date|after:today']));
        return back()->with('success','Défi créé.');
    }
    public function users(){return view('admin.users',['users'=>Client::where('is_admin',false)->paginate(20)]);}
    public function deleteUser(int $id){Client::findOrFail($id)->delete();return back()->with('success','Supprimé.');}
    public function badges(){return view('admin.badges',['badges'=>Badge::paginate(20)]);}
    public function storeBadge(Request $r){
        Badge::create($r->validate(['nom'=>'required','description'=>'required','icone'=>'required','points_requis'=>'required|integer|min:0']));
        return back()->with('success','Badge créé.');
    }
}
