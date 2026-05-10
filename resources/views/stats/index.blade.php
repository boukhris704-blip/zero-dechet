@extends('layouts.app')
@section('content')
<div class="row mb-4">
    <div class="col-12"><h2>📊 Dashboard Statistiques</h2></div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-success text-center p-3">
            <h3>{{ $totalScans }}</h3><p>📱 Total Scans</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info text-center p-3">
            <h3>{{ $totalProduits }}</h3><p>🛒 Produits</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning text-center p-3">
            <h3>{{ $totalUsers }}</h3><p>👥 Utilisateurs</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-primary text-center p-3">
            <h3>{{ number_format($totalCo2, 2) }} kg</h3><p>🌍 CO₂ économisé</p>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card shadow p-3">
            <h5>🌿 Score écologique par catégorie</h5>
            <canvas id="scoreCategorie"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow p-3">
            <h5>📱 Scans par mois</h5>
            <canvas id="scansMois"></canvas>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card shadow p-3">
            <h5>🏆 Top 5 utilisateurs</h5>
            <canvas id="topUsers"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow p-3">
            <h5>🌍 CO₂ économisé par mois</h5>
            <canvas id="co2Mois"></canvas>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow p-3">
            <h5>📊 Répartition des produits par catégorie</h5>
            <div style="max-width:400px;margin:auto">
                <canvas id="pieCategorie"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('scoreCategorie'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($categories->pluck('categorie')) !!},
        datasets: [{
            label: 'Score moyen',
            data: {!! json_encode($categories->pluck('score_moyen')) !!},
            backgroundColor: 'rgba(40,167,69,0.7)',
            borderColor: 'rgba(40,167,69,1)',
            borderWidth: 1
        }]
    },
    options: { scales: { y: { beginAtZero: true, max: 100 } } }
});

new Chart(document.getElementById('scansMois'), {
    type: 'line',
    data: {
        labels: {!! json_encode($scansMois->pluck('mois')) !!},
        datasets: [{
            label: 'Scans',
            data: {!! json_encode($scansMois->pluck('total')) !!},
            borderColor: 'rgba(0,123,255,1)',
            backgroundColor: 'rgba(0,123,255,0.1)',
            fill: true,
            tension: 0.4
        }]
    }
});

new Chart(document.getElementById('topUsers'), {
    type: 'bar',
    data: {
        labels: {!! json_encode(collect($topUsers)->pluck('nom')) !!},
        datasets: [{
            label: 'Points',
            data: {!! json_encode(collect($topUsers)->pluck('points')) !!},
            backgroundColor: ['#ffc107','#28a745','#007bff','#dc3545','#17a2b8'],
        }]
    },
    options: { indexAxis: 'y' }
});

new Chart(document.getElementById('co2Mois'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($co2Mois->pluck('mois')) !!},
        datasets: [{
            label: 'CO₂ (kg)',
            data: {!! json_encode($co2Mois->pluck('total_co2')) !!},
            backgroundColor: 'rgba(23,162,184,0.7)',
        }]
    }
});

new Chart(document.getElementById('pieCategorie'), {
    type: 'pie',
    data: {
        labels: {!! json_encode($pieCategories->pluck('categorie')) !!},
        datasets: [{
            data: {!! json_encode($pieCategories->pluck('total')) !!},
            backgroundColor: ['#28a745','#007bff','#ffc107','#dc3545','#17a2b8','#6f42c1','#fd7e14','#20c997']
        }]
    }
});
</script>
@endsection
