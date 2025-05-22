<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Public Routes (auth/register/login)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php'; // routes ديال Breeze


/*
|--------------------------------------------------------------------------
| Routes accessibles après login
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard global: Redirect selon rôle
    Route::get('/dashboard', [DashboardController::class, 'redirectUser'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/etudiants', [AdminController::class, 'etudiantsIndex'])->name('etudiants.index');
        Route::get('/etudiants/create', [AdminController::class, 'createEtudiant'])->name('etudiants.create');
        Route::post('/etudiants', [AdminController::class, 'storeEtudiant'])->name('etudiants.store');
    });

    /*
    |--------------------------------------------------------------------------
    | Etudiant Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:etudiant')->prefix('etudiant')->name('etudiant.')->group(function () {
        Route::get('/dashboard', [EtudiantController::class, 'index'])->name('dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | Enseignant Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:enseignant')->prefix('enseignant')->name('enseignant.')->group(function () {
        Route::get('/dashboard', [EnseignantController::class, 'index'])->name('dashboard');
    });

});

