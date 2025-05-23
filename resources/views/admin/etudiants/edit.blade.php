@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Modifier l'Étudiant : {{ $etudiant->nom }}</h2>

        <form action="{{ route('admin.etudiants.update', $etudiant) }}" method="POST">
            @csrf
            @method('PUT') {{-- Indique que c'est une requête PUT pour la mise à jour --}}

            <div class="mb-3">
                <label for="nom" class="form-label">Nom de l'étudiant</label>
                <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $etudiant->nom) }}" required>
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Adresse Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $etudiant->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Optionnel: Si vous voulez permettre la modification du mot de passe ici --}}
            <div class="mb-3">
                <label for="password" class="form-label">Nouveau Mot de passe (laisser vide si inchangé)</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="mb-3">
                <label for="classe_id" class="form-label">Classe</label>
                <select class="form-select @error('classe_id') is-invalid @enderror" id="classe_id" name="classe_id" required>
                    <option value="">Sélectionner une classe</option>
                    @foreach($classes as $classe)
                        <option value="{{ $classe->id }}" {{ old('classe_id', $etudiant->classesEtudiees->contains($classe->id) ? $classe->id : '') == $classe->id ? 'selected' : '' }}>{{ $classe->nom_classe }}</option>
                    @endforeach
                </select>
                @error('classe_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success me-2">Mettre à jour l'étudiant</button>
            <a href="{{ route('admin.etudiants.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
