@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4>🎯 Défis Personnalisés par IA</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-info">🤖 Défis générés selon vos habitudes d'achat</div>
                @foreach($defis as $defi)
                <div class="card mb-3 border-warning">
                    <div class="card-body">
                        <h5>{{ $defi['titre'] ?? 'Défi' }}</h5>
                        <p>{{ $defi['description'] ?? '' }}</p>
                        <span class="badge bg-warning text-dark">🏆 {{ $defi['points_recompense'] ?? 0 }} points</span>
                        <span class="badge bg-info ms-2">⏱️ {{ $defi['duree_jours'] ?? 7 }} jours</span>
                    </div>
                </div>
                @endforeach
                <a href="{{ route('dashboard') }}" class="btn btn-success mt-2">Retour</a>
            </div>
        </div>
    </div>
</div>
@endsection
