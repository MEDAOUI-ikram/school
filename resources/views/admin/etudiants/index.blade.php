@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Liste des Étudiants</h2>
           <a href="{{ route('admin.etudiants.create') }}" class="btn btn-primary">Ajouter un Étudiant</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($etudiants->isEmpty())
            <div class="alert alert-info">Aucun étudiant n'a été trouvé.</div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Classe</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($etudiants as $etudiant)
                            <tr>
                                <td>{{ $etudiant->id }}</td>
                                <td>{{ $etudiant->nom }}</td>
                                <td>{{ $etudiant->email }}</td>
                                <td>
                                    {{-- Assuming a many-to-many relationship where a student can be in multiple classes via classe_etudiants --}}
                                    @forelse($etudiant->classesEtudiees as $classe)
                                        {{ $classe->nom_classe }}@if(!$loop->last), @endif
                                    @empty
                                        N/A
                                    @endforelse
                                </td>
                                <td>
                                    <a href="{{ route('admin.etudiants.edit', $etudiant) }}" class="btn btn-sm btn-warning me-2">Modifier</a>
                                    <form action="{{ route('admin.etudiants.destroy', $etudiant) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
