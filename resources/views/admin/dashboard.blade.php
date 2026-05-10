@extends('layouts.app')
@section('title','Admin — Zéro Déchet')
@section('content')
<div class="topbar"><h4><i class="bi bi-shield-check me-2"></i>Administration</h4></div>
<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="card text-center p-3"><div class="fw-bold fs-3 text-primary">{{ $totalUsers }}</div><div class="text-muted">Utilisateurs</div><a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-primary mt-2">Gérer</a></div></div>
    <div class="col-md-3"><div class="card text-center p-3"><div class="fw-bold fs-3 text-success">{{ $totalProduits }}</div><div class="text-muted">Produits</div><a href="{{ route('admin.produits') }}" class="btn btn-sm btn-outline-success mt-2">Gérer</a></div></div>
    <div class="col-md-3"><div class="card text-center p-3"><div class="fw-bold fs-3 text-info">{{ $totalScans }}</div><div class="text-muted">Scans total</div></div></div>
    <div class="col-md-3"><div class="card text-center p-3"><div class="fw-bold fs-3 text-warning">{{ $totalDefis }}</div><div class="text-muted">Défis</div><a href="{{ route('admin.defis') }}" class="btn btn-sm btn-outline-warning mt-2">Gérer</a></div></div>
</div>
@endsection
