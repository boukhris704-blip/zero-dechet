@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4>🌿 {{ $produit->nom }}</h4>
            </div>
            <div class="card-body">
                <p><strong>Marque :</strong> {{ $produit->marque }}</p>
                <p><strong>Catégorie :</strong> {{ $produit->categorie }}</p>
                <p><strong>Score écologique :</strong> {{ $produit->score_eco }}/100</p>
                <p><strong>CO₂ :</strong> {{ $produit->co2_kg }} kg</p>

                @if($produit->score_eco >= 7)
                    <div class="alert alert-success">✅ Produit écologique !</div>
                @elseif($produit->score_eco >= 4)
                    <div class="alert alert-warning">⚠️ Produit moyen</div>
                @else
                    <div class="alert alert-danger">❌ Produit peu écologique</div>
                @endif

                <h5 class="mt-4">🌱 Alternatives écologiques</h5>
                @forelse($alternatives as $alt)
                <div class="card mb-2">
                    <div class="card-body d-flex justify-content-between">
                        <strong>{{ $alt->nom }}</strong>
                        <span class="badge bg-success">{{ $alt->score_eco }}/100</span>
                    </div>
                </div>
                @empty
                <p class="text-muted">Aucune alternative disponible</p>
                @endforelse

                @if($similaires->count() > 0)
                <h5 class="mt-4">🔄 Produits similaires</h5>
                @foreach($similaires as $sim)
                <div class="card mb-2">
                    <div class="card-body d-flex justify-content-between">
                        <strong>{{ $sim->nom }}</strong>
                        <span class="badge bg-info">{{ $sim->score_eco }}/10</span>
                    </div>
                </div>
                @endforeach
                @endif

                <a href="{{ route('scanner.index') }}" class="btn btn-success mt-3">
                    📱 Scanner un autre produit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
