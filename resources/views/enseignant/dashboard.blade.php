@extends('layouts.app')

@section('title', 'Enseignant Dashboard')
@section('page-title', 'Dashboard Enseignant')

@section('sidebar')
<nav class="nav flex-column">
    <a class="nav-link active" href="{{ route('enseignant.dashboard') }}">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
    <a class="nav-link" href="{{ route('enseignant.cours') }}">
        <i class="fas fa-book"></i> Mes Cours
    </a>
    <a class="nav-link" href="{{ route('enseignant.etudiants') }}">
        <i class="fas fa-users"></i> Mes Étudiants
    </a>
    <a class="nav-link" href="{{ route('enseignant.profile') }}">
        <i class="fas fa-user"></i> Mon Profil
    </a>
    <a class="nav-link" href="#">
        <i class="fas fa-calendar"></i> Planning
    </a>
    <a class="nav-link" href="#">
        <i class="fas fa-clipboard-list"></i> Évaluations
    </a>
</nav>
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            Bienvenue <strong>{{ $enseignant->name }}</strong>! Voici un aperçu de vos activités d'enseignement.
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-book fa-3x mb-3"></i>
                <h3>{{ $stats['mes_cours'] }}</h3>
                <p class="mb-0">Mes Cours</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-users fa-3x mb-3"></i>
                <h3>{{ $stats['mes_etudiants'] }}</h3>
                <p class="mb-0">Total Étudiants</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-clipboard-check fa-3x mb-3"></i>
                <h3>0</h3>
                <p class="mb-0">Évaluations</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-calendar-alt"></i> Emploi du Temps
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
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
                                <td class="bg-light-primary">Mathématiques<br><small>Salle A101</small></td>
                                <td></td>
                                <td class="bg-light-success">Physique<br><small>Salle B201</small></td>
                                <td></td>
                                <td class="bg-light-warning">Chimie<br><small>Lab C301</small></td>
                            </tr>
                            <tr>
                                <td><strong>10:00 - 12:00</strong></td>
                                <td></td>
                                <td class="bg-light-info">Algèbre<br><small>Salle A102</small></td>
                                <td></td>
                                <td class="bg-light-primary">Mathématiques<br><small>Salle A101</small></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><strong>14:00 - 16:00</strong></td>
                                <td class="bg-light-success">Physique<br><small>Salle B201</small></td>
                                <td></td>
                                <td class="bg-light-warning">Chimie<br><small>Lab C301</small></td>
                                <td></td>
                                <td class="bg-light-info">Algèbre<br><small>Salle A102</small></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-tasks"></i> Actions Rapides
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('enseignant.cours') }}" class="btn btn-primary">
                        <i class="fas fa-book"></i> Mes Cours
                    </a>
                    <a href="{{ route('enseignant.etudiants') }}" class="btn btn-outline-primary">
                        <i class="fas fa-users"></i> Voir Étudiants
                    </a>
                    <a href="#" class="btn btn-outline-success">
                        <i class="fas fa-plus"></i> Nouvelle Évaluation
                    </a>
                    <a href="#" class="btn btn-outline-warning">
                        <i class="fas fa-calendar-plus"></i> Programmer Cours
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-bell"></i> Notifications
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-light mb-2 py-2">
                    <small><i class="fas fa-info-circle text-info"></i> Nouveau message de l'administration</small>
                </div>
                <div class="alert alert-light mb-2 py-2">
                    <small><i class="fas fa-calendar text-warning"></i> Réunion prévue demain à 14h</small>
                </div>
                <div class="alert alert-light mb-0 py-2">
                    <small><i class="fas fa-clipboard text-success"></i> 3 devoirs à corriger</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
    .bg-light-primary { background-color: rgba(13, 110, 253, 0.1) !important; }
    .bg-light-success { background-color: rgba(25, 135, 84, 0.1) !important; }
    .bg-light-warning { background-color: rgba(255, 193, 7, 0.1) !important; }
    .bg-light-info { background-color: rgba(13, 202, 240, 0.1) !important; }
</style>
@endsection
