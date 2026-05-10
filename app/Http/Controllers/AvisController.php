<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AvisController extends Controller
{
    public function index()
    {
        $avis = DB::table('avis')
            ->join('clients', 'avis.utilisateur_id', '=', 'clients.id')
            ->select('avis.*', 'clients.prenom', 'clients.nom')
            ->orderByDesc('avis.created_at')
            ->get();
        return view('avis.index', compact('avis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'required|string|max:500',
        ]);

        DB::table('avis')->insert([
            'utilisateur_id' => Auth::id(),
            'note' => $request->note,
            'commentaire' => $request->commentaire,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('avis.index')->with('success', 'Avis publié !');
    }
}
