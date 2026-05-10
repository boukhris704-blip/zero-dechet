@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card p-3">
            <h5 class="fw-bold mb-3">👨‍👩‍👧 Famille Zéro Déchet</h5>
            @foreach($users as $user)
            <a href="{{ route('messages.conversation', $user->id) }}" 
               class="d-flex align-items-center p-2 mb-2 rounded text-decoration-none"
               style="background:#f8f9fa;transition:all 0.3s"
               onmouseover="this.style.background='#e8f5e9'"
               onmouseout="this.style.background='#f8f9fa'">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                     style="width:45px;height:45px;background:linear-gradient(135deg,#1a6b3c,#2d9e5f);color:white;font-weight:700;font-size:1.2rem">
                    {{ strtoupper(substr($user->prenom, 0, 1)) }}
                </div>
                <div>
                    <strong class="text-dark">{{ $user->prenom }} {{ $user->nom }}</strong>
                    <br><small class="text-muted">{{ $user->points }} pts 🏆</small>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <div class="col-md-8">
        <div class="card p-4 text-center" style="height:400px;display:flex;align-items:center;justify-content:center">
            <div>
                <div style="font-size:4rem">💬</div>
                <h5 class="text-muted mt-3">Sélectionnez un membre pour discuter</h5>
                <p class="text-muted">Partagez vos conseils écologiques avec la famille !</p>
            </div>
        </div>
    </div>
</div>
@endsection
