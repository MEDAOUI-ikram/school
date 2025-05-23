@extends('layouts.app')

@section('title', 'Étudiant Dashboard')
@section('page-title', 'Dashboard Étudiant')

@section('sidebar')
<nav class="nav flex-column">
    <a class="nav-link active" href="{{ route('etudiant.dashboard') }}">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
    <a class="nav-link" href="{{ route('etudiant.cours') }}">
        <i class="fas fa-book"></i> Mes Cours
    </a>
    <a class="nav-link" href="{{ route('etudiant.notes') }}">
        <i class="fas fa-star"></i> Mes Notes
    </a>
    <a class="nav-link" href="{{ route('etudiant.devoirs') }}">
        <i class="fas fa-clipboard-list"></i> Devoirs
    </a>
    <a class="nav-link" href="{{ route('etudiant.profile') }}">
        <i class="fas fa-user"></i> Mon Profil
    </a>
    <a class="nav-link" href="#">
        <i class="fas fa-calendar"></i> Planning
    </a>
</nav>
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="alert alert-success">
            <i class="fas fa-graduation-cap"></i>
            Bienvenue <strong>{{ $etudiant->name }}</strong>! Continuez vos efforts pour réussir vos études.
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-book fa-3x mb-3"></i>
                <h3>{{ $stats['mes_cours'] }}</h3>
                <p class="mb-0">Mes Cours</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-star fa-3x mb-3"></i>
                <h3>{{ $stats['mes_notes'] }}</h3>
                <p class="mb-0">Notes</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                <h3>{{ $stats['mes_devoirs'] }}</h3>
                <p class="mb-0">Devoirs</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-percentage fa-3x mb-3"></i>
                <h3>85%</h3>
                <p class="mb-0">Moyenne</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-calendar-week"></i> Mon Planning de la Semaine
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Heure</th>
                                <th>Lundi</th>
                                <th>Mardi</th>
                                <th>Mercredi</th>
                                <th>Jeudi</th>
                                <th>Vendredi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>08:00 - 10:00</strong></td>
                                <td class="bg-light-primary">Mathématiques<br><small>Prof. Alami</small></td>
                                <td></td>
                                <td class="bg-light-success">Physique<br><small>Prof. Bennani</small></td>
                                <td></td>
                                <td class="bg-light-warning">Chimie<br><small>Prof. Tazi</small></td>
                            </tr>
                            <tr>
                                <td><strong>10:30 - 12:30</strong></td>
                                <td></td>
                                <td class="bg-light-info">Français<br><small>Prof. Martin</small></td>
                                <td></td>
                                <td class="bg-light-primary">Mathémat
