<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{Message, Client};

class MessageController extends Controller
{
    public function index()
    {
        $user   = Auth::user();
        $users  = Client::where('id', '!=', $user->id)->get();
        $nonLus = Message::where('destinataire_id', $user->id)->where('lu', false)->count();
        return view('messages.index', compact('users', 'nonLus'));
    }

    public function conversation(int $userId)
    {
        $user     = Auth::user();
        $other    = Client::findOrFail($userId);
        $messages = Message::where(fn($q) => $q->where('expediteur_id', $user->id)->where('destinataire_id', $userId))
            ->orWhere(fn($q) => $q->where('expediteur_id', $userId)->where('destinataire_id', $user->id))
            ->orderBy('created_at')->get();
        Message::where('expediteur_id', $userId)->where('destinataire_id', $user->id)->where('lu', false)->update(['lu' => true]);
        return view('messages.conversation', compact('messages', 'other'));
    }

    public function send(Request $request)
    {
        $request->validate(['destinataire_id' => 'required|exists:clients,id', 'contenu' => 'required|string|max:1000']);
        Message::create(['expediteur_id' => Auth::id(), 'destinataire_id' => $request->destinataire_id, 'contenu' => $request->contenu]);
        return back()->with('success', 'Message envoyé !');
    }
}
