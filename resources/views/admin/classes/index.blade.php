@extends('layouts.app')  {{-- Assuming you have a layout --}}

@section('content')
    <div class="container">
        <h2>Liste des Classes</h2>
        <a href="{{ route('admin.classes.create') }}" class="btn btn-primary mb-3">Créer une Classe</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Année</th>
                    <th>Niveau</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classes as $classe)
                    <tr>
                        <td>{{ $classe->id }}</td>
                        <td>{{ $classe->nom_classe }}</td>
                        <td>{{ $classe->annee }}</td>
                        <td>{{ $classe->niveau->nom_niveau }}</td> {{-- Access the niveau name --}}
                        <td>
                            <a href="{{ route('admin.classes.edit', $classe) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('admin.classes.destroy', $classe) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
