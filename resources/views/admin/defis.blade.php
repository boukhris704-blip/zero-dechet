@extends('layouts.app')
@section('title','Admin Défis')
@section('content')
<div class="topbar"><h4>🏆 Gestion Défis</h4><a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">← Dashboard</a></div>
<div class="card mb-4">
    <div class="card-header fw-bold">Créer un défi</div>
    <div class="card-body">
        <form action="{{ route('admin.defis.store') }}" method="POST" class="row g-2">
            @csrf
            <div class="col-md-3"><input name="titre" class="form-control" placeholder="Titre du défi" required></div>
            <div class="col-md-4"><input name="description" class="form-control" placeholder="Description" required></div>
            <div class="col-md-2"><input name="points_recompense" type="number" min="1" class="form-control" placeholder="Points" required></div>
            <div class="col-md-2"><input name="date_fin" type="date" class="form-control" required></div>
            <div class="col-md-1"><button class="btn btn-success w-100">Créer</button></div>
        </form>
    </div>
</div>
<div class="card"><div class="table-responsive"><table class="table align-middle mb-0">
    <thead class="table-light"><tr><th>Titre</th><th>Points</th><th>Date fin</th><th>Participants</th><th>Statut</th></tr></thead>
    <tbody>
    @foreach($defis as $d)
    <tr>
        <td>{{ $d->titre }}</td>
        <td><span class="badge bg-success">+{{ $d->points_recompense }}</span></td>
        <td>{{ $d->date_fin->format('d/m/Y') }}</td>
        <td>{{ $d->participations->count() }}</td>
        <td>@if($d->estActif())<span class="badge bg-success">Actif</span>@else<span class="badge bg-secondary">Terminé</span>@endif</td>
    </tr>
    @endforeach
    </tbody>
</table></div></div>
@endsection
