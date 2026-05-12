@extends('layouts.app')
@section('title','Admin Users')
@section('content')
<div class="topbar"><h4>👥 Gestion Utilisateurs</h4><a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">← Dashboard</a></div>
<div class="card"><div class="table-responsive"><table class="table align-middle mb-0">
    <thead class="table-light"><tr><th>Nom</th><th>Email</th><th>Points</th><th>CO2 éco.</th><th></th></tr></thead>
    <tbody>
    @foreach($users as $u)
    <tr>
        <td>{{ $u->prenom }} {{ $u->nom }}</td>
        <td>{{ $u->email }}</td>
        <td><span class="badge bg-warning text-dark">{{ $u->points }}</span></td>
        <td>{{ $u->co2_economise }} kg</td>
        <td><form action="{{ route('admin.users.delete',$u->id) }}" method="POST" onsubmit="return confirm('Supprimer ?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">🗑</button></form></td>
    </tr>
    @endforeach
    </tbody>
</table></div>
@endsection
