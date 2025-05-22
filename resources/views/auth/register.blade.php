<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">
                <svg class="w-20 h-20 fill-current text-gray-500" viewBox="0 0 316 316">
                    <path d="M88.921 170.569L157.08 102.41l68.159 68.159-68.159 68.159zM157.08 316L0 157.08 157.08 0 316 157.08z" />
                </svg>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @if ($errors->any())
                <div class="mb-4">
                    <div class="font-medium text-red-600">
                        {{ __('Whoops! Something went wrong.') }}
                    </div>

                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <label for="nom" class="block font-medium text-sm text-gray-700">{{ __('Nom Complet') }}</label>
                    <input id="nom" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="nom" value="{{ old('nom') }}" required autofocus />
                    @error('nom')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="courriel" class="block font-medium text-sm text-gray-700">{{ __('Adresse E-mail') }}</label>
                    <input id="courriel" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="email" name="courriel" value="{{ old('courriel') }}" required />
                    @error('courriel')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="mot_de_passe" class="block font-medium text-sm text-gray-700">{{ __('Mot de Passe') }}</label>
                    <input id="mot_de_passe" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="password" name="mot_de_passe" required autocomplete="new-password" />
                    @error('mot_de_passe')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="mot_de_passe_confirmation" class="block font-medium text-sm text-gray-700">{{ __('Confirmer le Mot de Passe') }}</label>
                    <input id="mot_de_passe_confirmation" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="password" name="mot_de_passe_confirmation" required />
                    @error('mot_de_passe_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="role" class="block font-medium text-sm text-gray-700">{{ __('Rôle') }}</label>
                    <select id="role" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="role" required>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                        <option value="enseignant" {{ old('role') == 'enseignant' ? 'selected' : '' }}>Enseignant</option>
                        <option value="etudiant" {{ old('role') == 'etudiant' ? 'selected' : '' }} selected>Étudiant</option>
                    </select>
                    @error('role')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-end mt-4">
    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
        {{ __('Déjà inscrit(e) ?') }}
    </a>

    <button type="submit" >
        {{ __('S’inscrire') }}
    </button>
</div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
