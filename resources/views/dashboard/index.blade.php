@extends('layouts.app')
@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="page-title">🌿 Bonjour, {{ auth()->user()->prenom }} !</h2>
        <p class="text-muted">Bienvenue sur votre espace Zéro Déchet 🌍</p>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #1a6b3c, #2d9e5f)">
            <h3>{{ auth()->user()->points }}</h3>
            <p>🏆 Points gagnés</p>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #0077b6, #00b4d8)">
            <h3>{{ auth()->user()->co2_economise }} kg</h3>
            <p>🌍 CO₂ économisé</p>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #f77f00, #fcbf49)">
            <h3>{{ $derniersScans->count() }}</h3>
            <p>📱 Scans récents</p>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #7209b7, #b5179e)">
            <h3>{{ $badges->count() }}</h3>
            <p>🎖️ Badges obtenus</p>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12 mb-3">
        <div class="card p-4 text-center" style="background: linear-gradient(135deg, #1a6b3c, #2d9e5f); color:white; border-radius:20px">
            <h4>📱 Scanner un produit</h4>
            <p>Scannez le code-barres d'un produit pour voir son impact écologique</p>
            <a href="{{ route('scanner.index') }}" class="btn btn-light text-success fw-bold rounded-pill px-4">
                🔍 Scanner maintenant
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card p-4">
            <h5 class="fw-bold mb-3">🏆 Classement</h5>
            @forelse($classement as $i => $client)
            <div class="d-flex justify-content-between align-items-center mb-2 p-2 rounded" style="background:#f8f9fa">
                <span>
                    @if($i == 0) 🥇 @elseif($i == 1) 🥈 @elseif($i == 2) 🥉 @else {{ $i+1 }}. @endif
                    {{ $client->prenom }} {{ $client->nom }}
                </span>
                <span class="badge bg-success">{{ $client->points }} pts</span>
            </div>
            @empty
            <p class="text-muted">Aucun utilisateur</p>
            @endforelse
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card p-4">
            <h5 class="fw-bold mb-3">⚡ Défis en cours</h5>
            @forelse($defisActifs as $defi)
            <div class="mb-3 p-3 rounded" style="background:#fff9e6;border-left:4px solid #ffc107">
                <strong>{{ $defi->titre }}</strong>
                <span class="badge bg-warning text-dark float-end">{{ $defi->points_recompense }} pts</span>
                <br><small class="text-muted">Fin : {{ \Carbon\Carbon::parse($defi->date_fin)->format('d/m/Y') }}</small>
            </div>
            @empty
            <p class="text-muted">Aucun défi actif</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
Bayrem Dashboard
