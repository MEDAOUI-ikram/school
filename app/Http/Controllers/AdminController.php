<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function indexClasses()
    {
        $classes = Classe::with('niveau')->get(); // Eager load the 'niveau' relationship
        return view('admin.classes.index', compact('classes'));
    }

    public function createClasse()
    {
        $niveaux = Niveau::all();
        return view('admin.classes.create', compact('niveaux'));
    }

    public function storeClasse(Request $request)
    {
        $request->validate([
            'nom_classe' => 'required',
            'annee' => 'required',
            'niveau_id' => 'required|exists:niveaus,id', // Validate niveau_id
        ]);

        Classe::create($request->all());

        return redirect()->route('admin.classes.index')->with('success', 'Classe créée avec succès.');
    }

    public function editClasse(Classe $classe)
    {
        $niveaux = Niveau::all();
        return view('admin.classes.edit', compact('classe', 'niveaux'));
    }

    public function updateClasse(Request $request, Classe $classe)
    {
        $request->validate([
            'nom_classe' => 'required',
            'annee' => 'required',
            'niveau_id' => 'required|exists:niveaus,id', // Validate niveau_id
        ]);

        $classe->update($request->all());

        return redirect()->route('admin.classes.index')->with('success', 'Classe mise à jour avec succès.');
    }

    public function destroyClasse(Classe $classe)
    {
        $classe->delete();
        return redirect()->route('admin.classes.index')->with('success', 'Classe supprimée avec succès.');
    }
}
