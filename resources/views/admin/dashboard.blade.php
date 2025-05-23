@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard Administrateur')

@section('sidebar')
<nav class="nav flex-column">
    <a class="nav-link active" href="{{ route('admin.dashboard') }}">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
    <a class="nav-link" href="{{ route('admin.users') }}">
        <i class="fas fa-users"></i> Utilisateurs
    </a>
    <a class="nav-link" href="{{ route('admin.users.create') }}">
        <i class="fas fa-user-plus"></i> Ajouter Utilisateur
    </a>
    <a class="nav-link" href="#">
        <i class="fas fa-book"></i> Cours
    </a>
    <a class="nav-link" href="#">
        <i class="fas fa-chart-bar"></i> Statistiques
    </a>
</nav>
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-users fa-3x mb-3"></i>
                <h3>{{ $stats['total_users'] }}</h3>
                <p class="mb-0">Total Utilisateurs</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-graduation-cap fa-3x mb-3"></i>
                <h3>{{ $stats['total_etudiants'] }}</h3>
                <p class="mb-0">Étudiants</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-chalkboard-teacher fa-3x mb-3"></i>
                <h3>{{ $stats['total_enseignants'] }}</h3>
                <p class="mb-0">Enseignants</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-line"></i> Activités Récentes
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Utilisateur</th>
                                <th>Action</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ now()->format('d/m/Y H:i') }}</td>
                                <td>Système</td>
                                <td>Installation des rôles</td>
                                <td><span class="badge bg-success">Terminé</span></td>
                            </tr>
                            <tr>
                                <td>{{ now()->format('d/m/Y H:i') }}</td>
                                <td>Admin</td>
                                <td>Connexion au système</td>
                                <td><span class="badge bg-success">Succès</span></td>
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
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Ajouter Utilisateur
                    </a>
                    <a href="{{ route('admin.users') }}" class="btn btn-outline-primary">
                        <i class="fas fa-users"></i> Gérer Utilisateurs
                    </a>
                    <a href="#" class="btn btn-outline-secondary">
                        <i class="fas fa-book"></i> Gérer Cours
                    </a>
                    <a href="#" class="btn btn-outline-info">
                        <i class="fas fa-chart-bar"></i> Voir Rapports
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-info-circle"></i> Informations Système
                </h5>
            </div>
            <div class="card-body">
                <small class="text-muted">
                    <strong>Version:</strong> 1.0.0<br>
                    <strong>Laravel:</strong> {{ app()->version() }}<br>
                    <strong>PHP:</strong> {{ PHP_VERSION }}<br>
                    <strong>Dernière MAJ:</strong> {{ now()->format('d/m/Y') }}
                </small>
            </div>
        </div>
    </div>
</div>
@endsection
