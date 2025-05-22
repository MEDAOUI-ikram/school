<?php





namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\ClasseEnseignant
;
use App\Models\Matiere;
use App\Models\Enseignant;
use App\Models\User; // Pour les étudiants
use App\Models\ClasseEtudiant; // Pour la table pivot des étudiants et classes
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    // AdminController.php
public function dashboard()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('admin.dashboard'); // Make sure this view exists
        } else {
            abort(403, 'Unauthorized.'); // Or redirect to login
        }
    }
    // -------------------------------------------------------------------------
    // Gestion des Étudiants
    // -------------------------------------------------------------------------

    public function indexEtudiants()
    {
        $etudiants = User::where('role', 'etudiant')->with('classesEtudiees')->get();
        return view('admin.etudiants.index', compact('etudiants'));
    }

    public function createEtudiant()
    {
        $classes = Classe::all();
        return view('admin.etudiants.create', compact('classes'));
    }

    public function storeEtudiant(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'classe_id' => 'required|exists:classes,id',
            'role' => 'required|string|in:etudiant',
        ]);

        $etudiant = User::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'etudiant',
        ]);

        ClasseEtudiant::create([
            'user_id' => $etudiant->id,
            'classe_id' => $request->classe_id,
            'nom_groupe' => null, // Vous pouvez gérer les groupes si nécessaire
        ]);

        return redirect()->route('admin.etudiants.index')->with('success', 'Étudiant ajouté avec succès.');
    }

    public function editEtudiant(User $etudiant)
    {
        $classes = Classe::all();
        return view('admin.etudiants.edit', compact('etudiant', 'classes'));
    }

    public function updateEtudiant(Request $request, User $etudiant)
    {
        $rules = [
            'nom' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($etudiant->id),
            ],
            'classe_id' => 'required|exists:classes,id',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8|confirmed';
        }

        $request->validate($rules);

        $etudiant->nom = $request->nom;
        $etudiant->email = $request->email;

        if ($request->filled('password')) {
            $etudiant->password = Hash::make($request->password);
        }
        $etudiant->save();

        ClasseEtudiant::where('user_id', $etudiant->id)->delete();
        ClasseEtudiant::create([
            'user_id' => $etudiant->id,
            'classe_id' => $request->classe_id,
            'nom_groupe' => null,
        ]);

        return redirect()->route('admin.etudiants.index')->with('success', 'Étudiant mis à jour avec succès.');
    }

    public function destroyEtudiant(User $etudiant)
    {
        $etudiant->delete();
        return redirect()->route('admin.etudiants.index')->with('success', 'Étudiant supprimé avec succès.');
    }

    // -------------------------------------------------------------------------
    // Gestion des Enseignants
    // -------------------------------------------------------------------------

    public function indexEnseignants()
    {
        $Enseignants = Enseignant::all();
        return view('admin.Enseignants.index', compact('Enseignants'));
    }

    public function createEnseignant()
    {
        $matieres = Matiere::all();
        return view('admin.Enseignants.create', compact('matieres'));
    }

    public function storeEnseignant(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:Enseignants,email',
            'matiere_id' => 'nullable|exists:matieres,id', // Un Enseignant peut ne pas avoir de matière assignée immédiatement
        ]);

        Enseignant::create($request->all());

        return redirect()->route('admin.Enseignants.index')->with('success', 'Enseignant ajouté avec succès.');
    }

    public function editEnseignant(Enseignant $Enseignant)
    {
        $matieres = Matiere::all();
        return view('admin.Enseignants.edit', compact('Enseignant', 'matieres'));
    }

    public function updateEnseignant(Request $request, Enseignant $Enseignant)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('Enseignants')->ignore($Enseignant->id),
            ],
            'matiere_id' => 'nullable|exists:matieres,id',
        ]);

        $Enseignant->update($request->all());

        return redirect()->route('admin.Enseignants.index')->with('success', 'Enseignant mis à jour avec succès.');
    }

    public function destroyEnseignant(Enseignant $Enseignant)
    {
        $Enseignant->delete();
        return redirect()->route('admin.Enseignants.index')->with('success', 'Enseignant supprimé avec succès.');
    }

    // -------------------------------------------------------------------------
    // Gestion des Matières
    // -------------------------------------------------------------------------

    public function indexMatieres()
    {
        $matieres = Matiere::all();
        return view('admin.matieres.index', compact('matieres'));
    }

    public function createMatiere()
    {
        return view('admin.matieres.create');
    }

    public function storeMatiere(Request $request)
    {
        $request->validate([
            'nom_matiere' => 'required|string|max:255|unique:matieres,nom_matiere',
        ]);

        Matiere::create($request->all());

        return redirect()->route('admin.matieres.index')->with('success', 'Matière ajoutée avec succès.');
    }

    public function editMatiere(Matiere $matiere)
    {
        return view('admin.matieres.edit', compact('matiere'));
    }

    public function updateMatiere(Request $request, Matiere $matiere)
    {
        $request->validate([
            'nom_matiere' => [
                'required',
                'string',
                'max:255',
                Rule::unique('matieres')->ignore($matiere->id),
            ],
        ]);

        $matiere->update($request->all());

        return redirect()->route('admin.matieres.index')->with('success', 'Matière mise à jour avec succès.');
    }

    public function destroyMatiere(Matiere $matiere)
    {
        $matiere->delete();
        return redirect()->route('admin.matieres.index')->with('success', 'Matière supprimée avec succès.');
    }

    // -------------------------------------------------------------------------
    // Gestion des Classes
    // -------------------------------------------------------------------------

    public function indexClasses()
    {
        $classes = Classe::all();
        return view('admin.classes.index', compact('classes'));
    }

    public function createClasse()
    {
        return view('admin.classes.create');
    }

    public function storeClasse(Request $request)
    {
        $request->validate([
            'nom_classe' => 'required|string|max:255|unique:classes,nom_classe',
            'niveau' => 'nullable|string|max:255', // Exemple de niveau
        ]);

        Classe::create($request->all());

        return redirect()->route('admin.classes.index')->with('success', 'Classe ajoutée avec succès.');
    }

    public function editClasse(Classe $classe)
    {
        return view('admin.classes.edit', compact('classe'));
    }

    public function updateClasse(Request $request, Classe $classe)
    {
        $request->validate([
            'nom_classe' => [
                'required',
                'string',
                'max:255',
                Rule::unique('classes')->ignore($classe->id),
            ],
            'niveau' => 'nullable|string|max:255',
        ]);

        $classe->update($request->all());

        return redirect()->route('admin.classes.index')->with('success', 'Classe mise à jour avec succès.');
    }

    public function destroyClasse(Classe $classe)
    {
        $classe->delete();
        return redirect()->route('admin.classes.index')->with('success', 'Classe supprimée avec succès.');
    }

    // -------------------------------------------------------------------------
    // Gestion des Années Scolaires
    // -------------------------------------------------------------------------

    public function indexAnneesScolaires()
    {
        $anneesScolaires = AnneeScolaire::orderBy('debut_annee', 'desc')->get();
        return view('admin.annees_scolaires.index', compact('anneesScolaires'));
    }

    public function createAnneeScolaire()
    {
        return view('admin.annees_scolaires.create');
    }

    public function storeAnneeScolaire(Request $request)
    {
        $request->validate([
            'debut_annee' => 'required|date|unique:annee_scolaires,debut_annee',
            'fin_annee' => 'required|date|after:debut_annee|unique:annee_scolaires,fin_annee',
            'est_active' => 'nullable|boolean',
        ]);

        AnneeScolaire::create($request->all());

        return redirect()->route('admin.annees_scolaires.index')->with('success', 'Année scolaire ajoutée avec succès.');
    }

    public function editAnneeScolaire(AnneeScolaire $anneeScolaire)
    {
        return view('admin.annees_scolaires.edit', compact('anneeScolaire'));
    }

    public function updateAnneeScolaire(Request $request, AnneeScolaire $anneeScolaire)
    {
        $request->validate([
            'debut_annee' => [
                'required',
                'date',
                Rule::unique('annee_scolaires')->ignore($anneeScolaire->id),
            ],
            'fin_annee' => [
                'required',
                'date',
                'after:debut_annee',
                Rule::unique('annee_scolaires')->ignore($anneeScolaire->id),
            ],
            'est_active' => 'nullable|boolean',
        ]);

        $anneeScolaire->update($request->all());

        return redirect()->route('admin.annees_scolaires.index')->with('success', 'Année scolaire mise à jour avec succès.');
    }

    public function destroyAnneeScolaire(AnneeScolaire $anneeScolaire)
    {
        $anneeScolaire->delete();
        return redirect()->route('admin.annees_scolaires.index')->with('success', 'Année scolaire supprimée avec succès.');
    }

    // -------------------------------------------------------------------------
    // Gestion des Classes-Enseignants (Association)
    // -------------------------------------------------------------------------

    public function indexClassesEnseignants()
    {
        $classesEnseignants = ClasseEnseignant
        ::with(['classe', 'Enseignant', 'matiere'])->get();
        $classes = Classe::all();
        $Enseignants = Enseignant::all();
        $matieres = Matiere::all();
        return view('admin.classes_Enseignants.index', compact('classesEnseignants', 'classes', 'Enseignants', 'matieres'));
    }

    public function storeClasseEnseignant
    (Request $request)
    {
        $request->validate([
            'classe_id' => 'required|exists:classes,id',
            'Enseignant_id' => 'required|exists:Enseignants,id',
            'matiere_id' => 'required|exists:matieres,id',
        ]);

        // Vérifier si l'association existe déjà pour éviter les doublons
        $existingAssociation = ClasseEnseignant
        ::where([
            'classe_id' => $request->classe_id,
            'Enseignant_id' => $request->Enseignant_id,
            'matiere_id' => $request->matiere_id,
        ])->first();

        if ($existingAssociation) {
            return back()->withErrors(['message' => 'Cette association classe-Enseignant-matière existe déjà.']);
        }

        ClasseEnseignant
        ::create($request->all());

        return redirect()->route('admin.classes_Enseignants.index')->with('success', 'Association classe-Enseignant-matière créée avec succès.');
    }

    public function destroyClasseEnseignant
    (ClasseEnseignant
     $classeEnseignant
    )
    {
        $classeEnseignant
        ->delete();
        return redirect()->route('admin.classes_professeurs.index')->with('success', 'Association classe-professeur-matière supprimée avec succès.');
    }

    // -------------------------------------------------------------------------
    // Importation Excel (Méthodes à implémenter)
    // -------------------------------------------------------------------------

    public function importForm()
    {
        return view('admin.import');
    }

    public function importData(Request $request)
    {
        // Implémentez la logique d'importation des données Excel ici
        // Vous devrez probablement utiliser une librairie comme Maatwebsite\Excel
        return redirect()->route('admin.dashboard')->with('success', 'Données importées avec succès.');
    }

    // -------------------------------------------------------------------------
    // Rapports (Méthodes à implémenter)
    // -------------------------------------------------------------------------

    public function rapportsIndex()
    {
        return view('admin.rapports');
    }

    public function genererRapport(Request $request)
    {
        // Implémentez la logique de génération des rapports ici
        return response()->download('chemin/vers/votre/rapport.pdf'); // Exemple pour un téléchargement PDF
    }
}
