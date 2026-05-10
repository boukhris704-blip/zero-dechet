@extends('layouts.app')
@section('title','Conversation — Zéro Déchet')
@section('content')
<div class="topbar">
    <h4><i class="bi bi-chat me-2"></i>{{ $other->prenom }} {{ $other->nom }}</h4>
    <a href="{{ route('messages.index') }}" class="btn btn-sm btn-outline-secondary">← Retour</a>
</div>
<div class="card" style="max-width:700px;margin:auto">
    <div class="card-body" style="height:400px;overflow-y:auto;display:flex;flex-direction:column;gap:.75rem" id="msgs">
        @forelse($messages as $msg)
        @php $mine = $msg->expediteur_id === auth()->id(); @endphp
        <div class="d-flex {{ $mine?'justify-content-end':'' }}">
            <div style="max-width:70%;padding:.6rem 1rem;border-radius:16px;
                 background:{{ $mine?'#2D9E5F':'#f0f0f0' }};color:{{ $mine?'#fff':'#333' }}">
                {{ $msg->contenu }}
                <div style="font-size:.7rem;opacity:.7;margin-top:.2rem">{{ $msg->created_at->format('H:i') }}</div>
            </div>
        </div>
        @empty
        <p class="text-center text-muted">Début de la conversation</p>
        @endforelse
    </div>
    <div class="card-footer">
        <form action="{{ route('messages.send') }}" method="POST" class="d-flex gap-2">
            @csrf
            <input type="hidden" name="destinataire_id" value="{{ $other->id }}">
            <input type="text" name="contenu" class="form-control" placeholder="Écrire un message…" required autofocus>
            <button class="btn btn-success"><i class="bi bi-send"></i></button>
        </form>
    </div>
</div>
<script>
    document.getElementById('msgs').scrollTop = 9999;
</script>
@endsection
