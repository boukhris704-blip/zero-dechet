@extends('layouts.app')
@section('title','Défi — Zéro Déchet')
@section('content')
<div class="topbar">
    <h4><i class="bi bi-trophy me-2"></i>{{ $defi->titre }}</h4>
    <a href="{{ route('defis.index') }}" class="btn btn-sm btn-outline-secondary">← Retour</a>
</div>
<div class="row g-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h3 class="fw-bold">{{ $defi->titre }}</h3>
                <p class="text-muted">{{ $defi->description }}</p>
                <div class="d-flex gap-3 mt-3">
                    <div class="text-center p-3 rounded" style="background:#f0faf4">
                        <div class="fw-bold fs-4 text-success">+{{ $defi->points_recompense }}</div>
                        <div class="small text-muted">Points</div>
                    </div>
                    <div class="text-center p-3 rounded" style="background:#f0faf4">
                        <div class="fw-bold fs-4">{{ $defi->participations->count() }}</div>
                        <div class="small text-muted">Participants</div>
                    </div>
                    <div class="text-center p-3 rounded" style="background:#f0faf4">
                        <div class="fw-bold fs-4">{{ $defi->date_fin->format('d/m/Y') }}</div>
                        <div class="small text-muted">Date limite</div>
                    </div>
                </div>
                <div class="mt-4">
                    @if(!$participation && $defi->estActif())
                        <form action="{{ route('defis.participer',$defi->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success btn-lg">🎯 Participer à ce défi</button>
                        </form>
                    @elseif($participation)
                        <div class="alert alert-success">✅ Vous participez à ce défi !</div>
                    @else
                        <div class="alert alert-secondary">Ce défi est terminé.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Participants récents</div>
            <div class="card-body p-0">
                @forelse($participants as $p)
                <div class="px-3 py-2 border-bottom d-flex justify-content-between">
                    <span>{{ $p->utilisateur->prenom }} {{ $p->utilisateur->nom }}</span>
                    <small class="text-muted">{{ $p->created_at->diffForHumans() }}</small>
                </div>
                @empty
                <p class="text-muted text-center py-3">Soyez le premier !</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
