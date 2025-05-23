<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EnseignantController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:enseignant']);
    }

    public function dashboard()
    {
        $enseignant = auth()->user();

        $stats = [
            'mes_cours' => 0, // À adapter selon votre structure
            'mes_etudiants' => User::whereHas('role', function($q) {
                $q->where('name', 'etudiant');
            })->count(),
        ];

        return view('enseignant.dashboard', compact('stats', 'enseignant'));
    }

    public function profile()
    {
        $enseignant = auth()->user();
        return view('enseignant.profile', compact('enseignant'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('enseignant.profile')->with('success', 'Profil mis à jour avec succès!');
    }

    public function cours()
    {
        // Liste des cours de l'enseignant
        return view('enseignant.cours');
    }

    public function etudiants()
    {
        // Liste des étudiants
        $etudiants = User::whereHas('role', function($q) {
            $q->where('name', 'etudiant');
        })->paginate(10);

        return view('enseignant.etudiants', compact('etudiants'));
    }
}
