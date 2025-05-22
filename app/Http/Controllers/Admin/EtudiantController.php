<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EtudiantController extends Controller
{

// EtudiantController.php
public function dashboard()
{
    $user = Auth::user();
    $classes = $user->etudiantClasses; // Assuming you have a relationship defined
    $matieres = $user->etudiantMatieres; // Assuming you have a relationship defined

    return view('etudiant.dashboard', compact('classes', 'matieres'));
}
public function create()
{
    return view('etudiants.create');
}
}
