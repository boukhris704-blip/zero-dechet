@extends('layouts.app')
@section('title','Admin Badges')
@section('content')
<div class="topbar"><h4>🏅 Gestion Badges</h4><a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">← Dashboard</a></div>
<div class="card mb-4">
    <div class="card-header fw-bold">Créer un badge</div>
    <div class="card-body">
        <form action="{{ route('admin.badges.store') }}" method="POST" class="row g-2">
            @csrf
            <div class="col-md-3"><input name="nom" class="form-control" placeholder="Nom du badge" required></div>
            <div class="col-md-3"><input name="description" class="form-control" placeholder="Description" required></div>
            <div class="col-md-2"><input name="icone" class="form-control" placeholder="Emoji ex: 🌱" required></div>
            <div class="col-md-2"><input name="points_requis" type="number" min="0" class="form-control" placeholder="Points requis" required></div>
            <div class="col-md-2"><button class="btn btn-success w-100">Créer</button></div>
        </form>
    </div>
</div>
<div class="row g-3">
@foreach($badges as $b)
<div class="col-md-3">
    <div class="card text-center p-3">
        <div style="font-size:2.5rem">{{ $b->icone }}</div>
        <div class="fw-bold">{{ $b->nom }}</div>
        <div class="small text-muted">{{ $b->description }}</div>
        <span class="badge bg-secondary mt-1">{{ $b->points_requis }} pts</span>
    </div>
</div>
@endforeach
</div>
@endsection
