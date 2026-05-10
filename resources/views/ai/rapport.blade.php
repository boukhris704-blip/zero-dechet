@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4>📊 Rapport Écologique IA — {{ $user->prenom }}</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    🤖 <strong>Rapport généré par Intelligence Artificielle</strong>
                </div>
                <div style="white-space:pre-wrap;line-height:1.8">{{ $rapport }}</div>
                <a href="{{ route('dashboard') }}" class="btn btn-success mt-3">Retour au Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection
