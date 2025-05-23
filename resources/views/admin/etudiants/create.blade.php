@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Ajouter un nouvel Étudiant</h2>

        <form action="{{ route('admin.etudiants.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nom" class="form-label">Nom de l'étudiant</label>
                <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Adresse Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="mb-3">
                <label for="classe_id" class="form-label">Classe</label>
                <select class="form-select @error('classe_id') is-invalid @enderror" id="classe_id" name="classe_id" required>
                    <option value="">Sélectionner une classe</option>
                    @foreach($classes as $classe)
                        <option value="{{ $classe->id }}" {{ old('classe_id') == $classe->id ? 'selected' : '' }}>{{ $classe->nom_classe }}</option>
                    @endforeach
                </select>
                @error('classe_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Le rôle est fixe pour la création d'étudiants via cette interface --}}
            <input type="hidden" name="role" value="etudiant">

            <button type="submit" class="btn btn-success me-2">Enregistrer l'étudiant</button>
            <a href="{{ route('admin.etudiants.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
