<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\AdminController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome'); // Vous pouvez changer ceci pour votre page d'accueil
})->name('home');

// Routes pour l'authentification
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes pour l'interface administrateur (protégées par authentification et rôle)
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Gestion des classes
    Route::resource('classes', ClasseController::class);
    Route::get('/admin/classes/create', [AdminController::class, 'createClasse'])->name('admin.classes.create');
    Route::post('/admin/classes', [AdminController::class, 'storeClasse'])->name('admin.classes.store');
    Route::get('/admin/classes/{classe}/edit', [AdminController::class, 'editClasse'])->name('admin.classes.edit');
    Route::put('/admin/classes/{classe}', [AdminController::class, 'updateClasse'])->name('admin.classes.update');
    Route::delete('/admin/classes/{classe}', [AdminController::class, 'destroyClasse'])->name('admin.classes.destroy');

    // Gestion des matières
    Route::get('/admin/matieres', [AdminController::class, 'indexMatieres'])->name('admin.matieres.index');
    Route::get('/admin/matieres/create', [AdminController::class, 'createMatiere'])->name('admin.matieres.create');
    Route::post('/admin/matieres', [AdminController::class, 'storeMatiere'])->name('admin.matieres.store');
    Route::get('/admin/matieres/{matiere}/edit', [AdminController::class, 'editMatiere'])->name('admin.matieres.edit');
    Route::put('/admin/matieres/{matiere}', [AdminController::class, 'updateMatiere'])->name('admin.matieres.update');
    Route::delete('/admin/matieres/{matiere}', [AdminController::class, 'destroyMatiere'])->name('admin.matieres.destroy');

    // Gestion des niveaux
    Route::get('/admin/niveaus', [AdminController::class, 'indexNiveaus'])->name('admin.niveaus.index');
    Route::get('/admin/niveaus/create', [AdminController::class, 'createNiveau'])->name('admin.niveaus.create');
    Route::post('/admin/niveaus', [AdminController::class, 'storeNiveau'])->name('admin.niveaus.store');
    Route::get('/admin/niveaus/{niveau}/edit', [AdminController::class, 'editNiveau'])->name('admin.niveaus.edit');
    Route::put('/admin/niveaus/{niveau}', [AdminController::class, 'updateNiveau'])->name('admin.niveaus.update');
    Route::delete('/admin/niveaus/{niveau}', [AdminController::class, 'destroyNiveau'])->name('admin.niveaus.destroy');

    // Gestion des étudiants
    Route::get('/admin/etudiants', [AdminController::class, 'indexEtudiants'])->name('admin.etudiants.index');
    Route::get('/admin/etudiants/create', [AdminController::class, 'createEtudiant'])->name('admin.etudiants.create');
    Route::post('/admin/etudiants', [AdminController::class, 'storeEtudiant'])->name('admin.etudiants.store');
    Route::get('/admin/etudiants/{etudiant}/edit', [AdminController::class, 'editEtudiant'])->name('admin.etudiants.edit');
    Route::put('/admin/etudiants/{etudiant}', [AdminController::class, 'updateEtudiant'])->name('admin.etudiants.update');
    Route::delete('/admin/etudiants/{etudiant}', [AdminController::class, 'destroyEtudiant'])->name('admin.etudiants.destroy');

    // Gestion des professeurs
    Route::get('/admin/professeurs', [AdminController::class, 'indexProfesseurs'])->name('admin.professeurs.index');
    Route::get('/admin/professeurs/create', [AdminController::class, 'createProfesseur'])->name('admin.professeurs.create');
    Route::post('/admin/professeurs', [AdminController::class, 'storeProfesseur'])->name('admin.professeurs.store');
    Route::get('/admin/professeurs/{professeur}/edit', [AdminController::class, 'editProfesseur'])->name('admin.professeurs.edit');
    Route::put('/admin/professeurs/{professeur}', [AdminController::class, 'updateProfesseur'])->name('admin.professeurs.update');
    Route::delete('/admin/professeurs/{professeur}', [AdminController::class, 'destroyProfesseur'])->name('admin.professeurs.destroy');

    // Gestion des années scolaires
    Route::get('/admin/annees-scolaires', [AdminController::class, 'indexAnneesScolaires'])->name('admin.annees_scolaires.index');
    Route::get('/admin/annees-scolaires/create', [AdminController::class, 'createAnneeScolaire'])->name('admin.annees_scolaires.create');
    Route::post('/admin/annees-scolaires', [AdminController::class, 'storeAnneeScolaire'])->name('admin.annees_scolaires.store');
    Route::get('/admin/annees-scolaires/{annee_scolaire}/edit', [AdminController::class, 'editAnneeScolaire'])->name('admin.annees_scolaires.edit');
    Route::put('/admin/annees-scolaires/{annee_scolaire}', [AdminController::class, 'updateAnneeScolaire'])->name('admin.annees_scolaires.update');
    Route::delete('/admin/annees-scolaires/{annee_scolaire}', [AdminController::class, 'destroyAnneeScolaire'])->name('admin.annees_scolaires.destroy');

    // Gestion des classes_professeurs (Association des professeurs aux classes)
    Route::get('/admin/classes-professeurs', [AdminController::class, 'indexClassesProfesseurs'])->name('admin.classes_professeurs.index');
    Route::get('/admin/classes-professeurs/create', [AdminController::class, 'createClasseProfesseur'])->name('admin.classes_professeurs.create');
    Route::post('/admin/classes-professeurs', [AdminController::class, 'storeClasseProfesseur'])->name('admin.classes_professeurs.store');
    Route::get('/admin/classes-professeurs/{classe_professeur}/edit', [AdminController::class, 'editClasseProfesseur'])->name('admin.classes_professeurs.edit');
    Route::put('/admin/classes-professeurs/{classe_professeur}', [AdminController::class, 'updateClasseProfesseur'])->name('admin.classes_professeurs.update');
    Route::delete('/admin/classes-professeurs/{classe_professeur}', [AdminController::class, 'destroyClasseProfesseur'])->name('admin.classes_professeurs.destroy');

    // Importation
    Route::get('/admin/import', [AdminController::class, 'importForm'])->name('admin.import');
    Route::post('/admin/import', [AdminController::class, 'processImport'])->name('admin.import.process');

    // Rapports
    Route::get('/admin/rapports', [AdminController::class, 'showRapports'])->name('admin.rapports');
    // Ajoutez ici des routes spécifiques pour générer des rapports (ex: /admin/rapports/etudiants, /admin/rapports/classes)
});



// Routes pour l'interface enseignant (protégées par authentification et rôle)
Route::prefix('enseignant')->middleware(['auth', 'role:enseignant'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'enseignantDashboard'])->name('enseignant.dashboard');
    // Ajoutez ici d'autres routes spécifiques à l'enseignant
    // Exemple: Route::get('/gestion-notes', [EnseignantController::class, 'gestionNotes'])->name('enseignant.notes');
});

// Routes pour l'interface étudiant (protégées par authentification et rôle)
Route::prefix('etudiant')->middleware(['auth', 'role:etudiant'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'etudiantDashboard'])->name('etudiant.dashboard');
    // Ajoutez ici d'autres routes spécifiques à l'étudiant
    // Exemple: Route::get('/voir-notes', [EtudiantController::class, 'voirNotes'])->name('etudiant.notes');
});

// Si vous avez une page d'accueil spécifique après la connexion, vous pouvez la définir ici
Route::get('/accueil', function () {
    return view('accueil'); // Créez cette vue si nécessaire
})->middleware('auth')->name('accueil');
