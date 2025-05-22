@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tableau de Bord de l'Administrateur</h2>

        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Étudiants</h5>
                        <p class="card-text">{{ $studentCount }}</p>
                        <a href="{{ route('admin.etudiants.index') }}" class="btn btn-primary btn-sm">Gérer</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Professeurs</h5>
                        <p class="card-text">{{ $teacherCount }}</p>
                        <a href="{{ route('admin.professeurs.index') }}" class="btn btn-primary btn-sm">Gérer</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Classes</h5>
                        <p class="card-text">{{ $classCount }}</p>
                        <a href="{{ route('admin.classes.index') }}" class="btn btn-primary btn-sm">Gérer</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Matières</h5>
                        <p class="card-text">{{ $subjectCount }}</p>
                        <a href="{{ route('admin.matieres.index') }}" class="btn btn-primary btn-sm">Gérer</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Add more widgets and information as needed --}}
    </div>
@endsection
