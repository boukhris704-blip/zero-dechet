@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h4>🌍 Empreinte Carbone — {{ $user->prenom }}</h4>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-6">
                        <div class="card bg-success text-white text-center p-3">
                            <h3>{{ $totalCo2 }} kg</h3>
                            <p>CO₂ économisé</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-primary text-white text-center p-3">
                            <h3>{{ $totalScans }}</h3>
                            <p>Produits scannés</p>
                        </div>
                    </div>
                </div>
                <div class="alert alert-info">🤖 Analyse IA</div>
                <div style="white-space:pre-wrap;line-height:1.8">{{ $analyse }}</div>
                <a href="{{ route('dashboard') }}" class="btn btn-success mt-3">Retour</a>
            </div>
        </div>
    </div>
</div>
@endsection
