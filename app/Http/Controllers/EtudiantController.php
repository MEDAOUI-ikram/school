<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EtudiantController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:etudiant']);
    }

    public function dashboard()
    {
        $etudiant = auth()->user();

        $stats = [
            'mes_cours' => 0, // À adapter selon votre structure
            'mes_notes' => 0, // À adapter selon votre structure
            'mes_devoirs' => 0, // À adapter selon votre structure
        ];

        return view('etudiant.dashboard', compact('stats', 'etudiant'));
    }

    public function profile()
    {
        $etudiant = auth()->user();
        return view('etudiant.profile', compact('etudiant'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('etudiant.profile')->with('success', 'Profil mis à jour avec succès!');
    }

    public function cours()
    {
        // Liste des cours de l'étudiant
        return view('etudiant.cours');
    }

    // public function notes()
    // {
    //     // Notes de l'étudiant
    //     return view('etudiant.notes');
    // }

    // public function devoirs()
    // {
    //     // Devoirs de l'étudiant
    //     return view('etudiant.devoirs');
    // }
}
