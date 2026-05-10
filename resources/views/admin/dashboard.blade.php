@extends('layouts.app')
@section('content')

<div class="row mb-4">
    <div class="col-12">
        <div class="p-4 rounded-4 text-white" style="background: linear-gradient(135deg, #1a6b3c, #2d9e5f)">
            <h2 class="fw-bold mb-1">⚙️ Panel Administration</h2>
            <p class="mb-0 opacity-75">Gérez votre plateforme Zéro Déchet</p>
        </div>
    </div>
</div>

<!-- Stats cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card border-0 rounded-4 shadow-sm h-100" style="border-left: 5px solid #0077b6 !important">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 fw-500">👥 Utilisateurs</p>
                        <h2 class="fw-bold text-primary mb-0">{{ $nbUsers }}</h2>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="width:60px;height:60px;background:#e8f4fd;font-size:1.8rem">👥</div>
                </div>
                <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-primary rounded-pill mt-3 w-100">
                    Gérer →
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card border-0 rounded-4 shadow-sm h-100" style="border-left: 5px solid #28a745 !important">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">🛒 Produits</p>
                        <h2 class="fw-bold text-success mb-0">{{ $nbProduits }}</h2>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="width:60px;height:60px;background:#e8f5e9;font-size:1.8rem">🛒</div>
                </div>
                <a href="{{ route('admin.produits') }}" class="btn btn-sm btn-outline-success rounded-pill mt-3 w-100">
                    Gérer →
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card border-0 rounded-4 shadow-sm h-100" style="border-left: 5px solid #ffc107 !important">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">⚡ Défis</p>
                        <h2 class="fw-bold text-warning mb-0">{{ $nbDefis }}</h2>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="width:60px;height:60px;background:#fff8e1;font-size:1.8rem">⚡</div>
                </div>
                <a href="{{ route('admin.defis') }}" class="btn btn-sm btn-outline-warning rounded-pill mt-3 w-100">
                    Gérer →
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card border-0 rounded-4 shadow-sm h-100" style="border-left: 5px solid #6f42c1 !important">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">📱 Scans</p>
                        <h2 class="fw-bold mb-0" style="color:#6f42c1">{{ $nbScans }}</h2>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="width:60px;height:60px;background:#f3e5f5;font-size:1.8rem">📱</div>
                </div>
                <a href="{{ route('stats.index') }}" class="btn btn-sm rounded-pill mt-3 w-100"
                   style="border-color:#6f42c1;color:#6f42c1">
                    Voir Stats →
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Actions rapides -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">⚡ Actions rapides</h5>
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="{{ route('admin.users') }}" class="btn w-100 rounded-3 p-3 text-white fw-bold"
                           style="background:linear-gradient(135deg,#0077b6,#00b4d8)">
                            👥 Gérer utilisateurs
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.produits') }}" class="btn w-100 rounded-3 p-3 text-white fw-bold"
                           style="background:linear-gradient(135deg,#1a6b3c,#2d9e5f)">
                            🛒 Gérer produits
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.defis') }}" class="btn w-100 rounded-3 p-3 text-white fw-bold"
                           style="background:linear-gradient(135deg,#f77f00,#fcbf49)">
                            ⚡ Gérer défis
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.badges') }}" class="btn w-100 rounded-3 p-3 text-white fw-bold"
                           style="background:linear-gradient(135deg,#7209b7,#b5179e)">
                            🎖️ Gérer badges
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Derniers utilisateurs -->
<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">👥 Derniers utilisateurs</h5>
                @foreach($dernersUsers as $user)
                <div class="d-flex align-items-center mb-3 p-2 rounded-3" style="background:#f8f9fa">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 text-white fw-bold"
                         style="width:40px;height:40px;background:linear-gradient(135deg,#1a6b3c,#2d9e5f);font-size:1rem">
                        {{ strtoupper(substr($user->prenom, 0, 1)) }}
                    </div>
                    <div class="flex-grow-1">
                        <strong>{{ $user->prenom }} {{ $user->nom }}</strong>
                        <br><small class="text-muted">{{ $user->email }}</small>
                    </div>
                    <span class="badge rounded-pill bg-success">{{ $user->points }} pts</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">🛒 Derniers produits</h5>
                @foreach($derniersProduits as $produit)
                <div class="d-flex align-items-center mb-3 p-2 rounded-3" style="background:#f8f9fa">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                         style="width:40px;height:40px;background:#e8f5e9;font-size:1.2rem">🌿</div>
                    <div class="flex-grow-1">
                        <strong>{{ $produit->nom }}</strong>
                        <br><small class="text-muted">{{ $produit->categorie }}</small>
                    </div>
                    <span class="badge rounded-pill"
                          style="background:{{ $produit->score_eco >= 70 ? '#28a745' : ($produit->score_eco >= 40 ? '#ffc107' : '#dc3545') }}">
                        {{ $produit->score_eco }}/100
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
