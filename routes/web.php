<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EtudiantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication Routes (Accessible to all, or at least to unauthenticated users)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Show login form
Route::post('/login', [AuthController::class, 'login'])->name('login.post');   // Handle login submission
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');     // Handle logout

// Admin Routes (Accessible to authenticated users with the "admin" role)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'indexUsers'])->name('admin.users');
    Route::get('/admin/classes', [AdminController::class, 'indexClasses'])->name('admin.classes');
    Route::get('/admin/classes/create', [AdminController::class, 'createClasse'])->name('admin.classes.create');
    Route::post('/admin/classes', [AdminController::class, 'storeClasse'])->name('admin.classes.store');
    Route::get('/admin/classes/{classe}/edit', [AdminController::class, 'editClasse'])->name('admin.classes.edit');
    Route::put('/admin/classes/{classe}', [AdminController::class, 'updateClasse'])->name('admin.classes.update');
    Route::delete('/admin/classes/{classe}', [AdminController::class, 'destroyClasse'])->name('admin.classes.destroy');
    Route::get('/admin/matieres', [AdminController::class, 'indexMatieres'])->name('admin.matieres.index');
    Route::get('/admin/matieres/create', [AdminController::class, 'createMatiere'])->name('admin.matieres.create');
    Route::post('/admin/matieres', [AdminController::class, 'storeMatiere'])->name('admin.matieres.store');
    Route::get('/admin/matieres/{matiere}/edit', [AdminController::class, 'editMatiere'])->name('admin.matieres.edit');
    Route::put('/admin/matieres/{matiere}', [AdminController::class, 'updateMatiere'])->name('admin.matieres.update');
    Route::delete('/admin/matieres/{matiere}', [AdminController::class, 'destroyMatiere'])->name('admin.matieres.destroy');
    Route::get('/admin/niveaus', [AdminController::class, 'indexNiveaus'])->name('admin.niveaus.index');
    Route::get('/admin/niveaus/create', [AdminController::class, 'createNiveau'])->name('admin.niveaus.create');
    Route::post('/admin/niveaus', [AdminController::class, 'storeNiveau'])->name('admin.niveaus.store');
    Route::get('/admin/niveaus/{niveau}/edit', [AdminController::class, 'editNiveau'])->name('admin.niveaus.edit');
    Route::put('/admin/niveaus/{niveau}', [AdminController::class, 'updateNiveau'])->name('admin.niveaus.update');
    Route::delete('/admin/niveaus/{niveau}', [AdminController::class, 'destroyNiveau'])->name('admin.niveaus.destroy');
    // ... other admin routes (users, reports, etc.)
});

// Enseignant Routes (Accessible to authenticated users with the "enseignant" role)
Route::middleware(['auth', 'role:enseignant'])->group(function () {
    Route::get('/enseignant/classes', [EnseignantController::class, 'indexClasses'])->name('enseignant.classes');
    Route::get('/enseignant/matieres', [EnseignantController::class, 'indexMatieres'])->name('enseignant.matieres');
    // ... other enseignant routes (view emploi du temps, etc.)
});

// Etudiant Routes (Accessible to authenticated users with the "etudiant" role)
Route::middleware(['auth', 'role:etudiant'])->group(function () {
    Route::get('/etudiant/info', [EtudiantController::class, 'showInfo'])->name('etudiant.info');
    Route::get('/etudiant/classes', [EtudiantController::class, 'indexClasses'])->name('etudiant.classes');
    Route::get('/etudiant/matieres', [EtudiantController::class, 'indexMatieres'])->name('etudiant.matieres');
    // ... other etudiant routes (view emploi du temps, etc.)
});

// Common Routes (Accessible to multiple roles, if needed - but be careful with this)
// Route::middleware(['auth', 'role:enseignant,etudiant'])->group(function () {
//     Route::get('/common/emploi-du-temps', [CommonController::class, 'emploiDuTemps'])->name('common.emploi-du-temps');
// });
