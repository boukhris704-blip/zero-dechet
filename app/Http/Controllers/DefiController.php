<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{Defi, Participation};

class DefiController extends Controller
{
    public function index()
    {
        $user           = Auth::user();
        $defis          = Defi::orderBy('date_fin')->get();
        $defilsRejoints = Participation::where('utilisateur_id',$user->id)->pluck('defi_id')->toArray();
        return view('defis.index', compact('defis','defilsRejoints'));
    }
    public function show(int $id)
    {
        $defi          = Defi::findOrFail($id);
        $participation = Participation::where('utilisateur_id',Auth::id())->where('defi_id',$id)->first();
        $participants  = Participation::with('utilisateur')->where('defi_id',$id)->latest()->take(10)->get();
        return view('defis.show', compact('defi','participation','participants'));
    }
    public function participer(int $id)
    {
        $user = Auth::user(); $defi = Defi::findOrFail($id);
        if (!$defi->estActif()) return back()->with('error','Ce défi est terminé.');
        if (Participation::where('utilisateur_id',$user->id)->where('defi_id',$id)->exists())
            return back()->with('warning','Vous participez déjà.');
        Participation::create(['utilisateur_id'=>$user->id,'defi_id'=>$id]);
        $user->ajouterPoints($defi->points_recompense);
        return back()->with('success',"Inscrit ! +{$defi->points_recompense} points 🎉");
    }
}
