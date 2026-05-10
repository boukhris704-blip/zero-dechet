@extends('layouts.app')
@section('title','Produits — Zéro Déchet')
@section('content')
<div class="topbar">
    <h4><i class="bi bi-box-seam me-2"></i>Catalogue Produits</h4>
    <a href="{{ route('scanner.index') }}" class="btn btn-success btn-sm">
        <i class="bi bi-upc-scan me-1"></i>Scanner un produit
    </a>
</div>

<form method="GET" class="row g-2 mb-4">
    <div class="col-md-6">
        <input type="text" name="search" class="form-control" placeholder="Rechercher un produit ou code-barres…"
               value="{{ request('search') }}">
    </div>
    <div class="col-md-4">
        <select name="categorie" class="form-select">
            <option value="">Toutes les catégories</option>
            @foreach($categories as $cat)
            <option value="{{ $cat }}" {{ request('categorie')==$cat?'selected':'' }}>{{ $cat }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-outline-success w-100">Filtrer</button>
    </div>
</form>

<div class="row g-3">
    @forelse($produits as $p)
    @php
        $bg = $p->score_eco>=80?'#d4edda':($p->score_eco>=60?'#cce5ff':($p->score_eco>=40?'#fff3cd':'#f8d7da'));
        $co = $p->score_eco>=80?'#155724':($p->score_eco>=60?'#004085':($p->score_eco>=40?'#856404':'#721c24'));
    @endphp
    <div class="col-md-4">
        <a href="{{ route('produits.show',$p->codeBarres) }}" class="text-decoration-none">
            <div class="card h-100 p-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:55px;height:55px;border-radius:50%;background:{{$bg}};color:{{$co}};
                         display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.1rem;flex-shrink:0">
                        {{ $p->score_eco }}
                    </div>
                    <div>
                        <div class="fw-bold text-dark">{{ $p->nom }}</div>
                        <div class="text-muted small">{{ $p->marque ?? 'Marque inconnue' }}</div>
                        <span class="badge bg-light text-dark border small">{{ $p->categorie }}</span>
                    </div>
                </div>
                <div class="mt-2 progress" style="height:6px;border-radius:4px">
                    <div class="progress-bar" style="width:{{$p->score_eco}}%;background:{{$co}}"></div>
                </div>
            </div>
        </a>
    </div>
    @empty
    <div class="col-12 text-center py-5 text-muted">
        <i class="bi bi-box fs-1"></i><p class="mt-2">Aucun produit trouvé</p>
    </div>
    @endforelse
</div>
<div class="mt-4">{{ $produits->links() }}</div>
@endsection
