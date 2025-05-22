<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnseignantController extends Controller
{

// EnseignantController.php
public function dashboard()
{
    $user = Auth::user();
    $classes = $user->enseignantClasses; // Assuming you have a relationship defined
    $matieres = $user->enseignantMatieres; // Assuming you have a relationship defined

    return view('enseignant.dashboard', compact('classes', 'matieres'));
}


}
