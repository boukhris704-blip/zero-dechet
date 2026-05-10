{{-- admin/produits.blade.php --}}
@extends('layouts.app')
@section('title','Admin Produits')
@section('content')
<div class="topbar"><h4>🛒 Gestion Produits</h4><a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">← Dashboard</a></div>
<div class="card mb-4">
    <div class="card-header fw-bold">Ajouter un produit</div>
    <div class="card-body">
        <form action="{{ route('admin.produits.store') }}" method="POST" class="row g-2">
            @csrf
            <div class="col-md-2"><input name="codeBarres" class="form-control" placeholder="Code-barres" required></div>
            <div class="col-md-3"><input name="nom" class="form-control" placeholder="Nom produit" required></div>
            <div class="col-md-2"><input name="marque" class="form-control" placeholder="Marque"></div>
            <div class="col-md-2"><input name="categorie" class="form-control" placeholder="Catégorie" required></div>
            <div class="col-md-1"><input name="score_eco" type="number" min="0" max="100" class="form-control" placeholder="Score" required></div>
            <div class="col-md-1"><input name="co2_kg" type="number" step="0.001" class="form-control" placeholder="CO2" required></div>
            <div class="col-md-1"><button class="btn btn-success w-100">Ajouter</button></div>
        </form>
    </div>
</div>
<div class="card"><div class="table-responsive"><table class="table align-middle mb-0">
    <thead class="table-light"><tr><th>Code</th><th>Nom</th><th>Marque</th><th>Catégorie</th><th>Score</th><th>CO2</th><th></th></tr></thead>
    <tbody>
    @foreach($produits as $p)
    <tr>
        <td><code>{{ $p->codeBarres }}</code></td><td>{{ $p->nom }}</td><td>{{ $p->marque }}</td><td>{{ $p->categorie }}</td>
        <td><span class="badge bg-{{ $p->couleur }}">{{ $p->score_eco }}/100</span></td><td>{{ $p->co2_kg }} kg</td>
        <td><form action="{{ route('admin.produits.delete',$p->codeBarres) }}" method="POST" onsubmit="return confirm('Supprimer ?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">🗑</button></form></td>
    </tr>
    @endforeach
    </tbody>
</table></div>
</div>
@endsection
