@extends('layouts.app')
@section('title','Défis — Zéro Déchet')
@section('content')
<div class="topbar"><h4><i class="bi bi-trophy me-2"></i>Défis Communautaires</h4></div>
<div class="row g-3">
@forelse($defis as $defi)
<div class="col-md-6">
    <div class="card h-100">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <h5 class="fw-bold">{{ $defi->titre }}</h5>
                <span class="badge bg-success fs-6">+{{ $defi->points_recompense }} pts</span>
            </div>
            <p class="text-muted">{{ $defi->description }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    @if($defi->estActif())
                        <span class="text-success">✅ Actif jusqu'au {{ $defi->date_fin->format('d/m/Y') }}</span>
                    @else
                        <span class="text-danger">❌ Terminé</span>
                    @endif
                </small>
                <div>
                    @if(in_array($defi->id, $defilsRejoints))
                        <span class="badge bg-secondary">Déjà inscrit</span>
                    @elseif($defi->estActif())
                        <form action="{{ route('defis.participer',$defi->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-success">Participer</button>
                        </form>
                    @endif
                    <a href="{{ route('defis.show',$defi->id) }}" class="btn btn-sm btn-outline-secondary ms-1">Détails</a>
                </div>
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-12 text-center text-muted py-5"><i class="bi bi-trophy fs-1"></i><p>Aucun défi disponible</p></div>
@endforelse
</div>
@endsection
