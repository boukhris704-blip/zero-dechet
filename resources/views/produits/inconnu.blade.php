@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4>🔍 Produit inconnu</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    Code-barres <strong>{{ $codeBarres }}</strong> non trouvé.<br>
                    Entrez le nom du produit pour que l'IA l'analyse !
                </div>
                <form method="POST" action="{{ route('produits.analyser') }}">
                    @csrf
                    <input type="hidden" name="codeBarres" value="{{ $codeBarres }}">
                    <div class="mb-3">
                        <label class="form-label">Nom du produit</label>
                        <input type="text" name="nom" class="form-control form-control-lg"
                               placeholder="Ex: Eau Mira 1.5L" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Marque</label>
                        <input type="text" name="marque" class="form-control"
                               placeholder="Ex: Mira">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catégorie</label>
                        <select name="categorie" class="form-control">
                            <option>Boissons</option>
                            <option>Alimentaire</option>
                            <option>Hygiène</option>
                            <option>Cosmétiques</option>
                            <option>Ménager</option>
                            <option>Papeterie</option>
                            <option>Général</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg w-100">
                        🤖 Analyser avec IA
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
