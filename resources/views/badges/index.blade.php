@extends('layouts.app')
@section('title','Badges — Zéro Déchet')
@section('content')
<div class="topbar">
    <h4><i class="bi bi-award me-2"></i>Mes Badges</h4>
    <span class="text-muted">{{ count($obtenus) }} / {{ $tousBadges->count() }} obtenus</span>
</div>
<div class="row g-3">
@foreach($tousBadges as $badge)
@php $obtenu = in_array($badge->id, $obtenus); @endphp
<div class="col-md-4">
    <div class="card text-center p-3 h-100 {{ $obtenu?'':'opacity-50' }}">
        <div style="font-size:3rem">{{ $badge->icone }}</div>
        <div class="fw-bold mt-2">{{ $badge->nom }}</div>
        <div class="text-muted small">{{ $badge->description }}</div>
        <div class="mt-2">
            @if($obtenu)
                <span class="badge bg-success">✅ Obtenu</span>
            @else
                <span class="badge bg-secondary">{{ $badge->points_requis }} points requis</span>
                <div class="progress mt-2" style="height:6px">
                    <div class="progress-bar bg-success" style="width:{{ min(100, ($user->points/$badge->points_requis)*100) }}%"></div>
                </div>
                <small class="text-muted">{{ $user->points }}/{{ $badge->points_requis }} pts</small>
            @endif
        </div>
    </div>
</div>
@endforeach
</div>
@endsection
