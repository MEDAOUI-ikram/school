<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EtudiantController;

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

Route::get('/', function () {
    return view('welcome');
});

// Routes d'authentification
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Routes pour Admin
Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
});

// Routes pour Enseignant
Route::group(['middleware' => ['auth', 'role:enseignant'], 'prefix' => 'enseignant', 'as' => 'enseignant.'], function() {
    Route::get('/dashboard', [EnseignantController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [EnseignantController::class, 'profile'])->name('profile');
    Route::put('/profile', [EnseignantController::class, 'updateProfile'])->name('profile.update');
    Route::get('/cours', [EnseignantController::class, 'cours'])->name('cours');
    Route::get('/etudiants', [EnseignantController::class, 'etudiants'])->name('etudiants');
});

// Routes pour Etudiant
Route::group(['middleware' => ['auth', 'role:etudiant'], 'prefix' => 'etudiant', 'as' => 'etudiant.'], function() {
    Route::get('/dashboard', [EtudiantController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [EtudiantController::class, 'profile'])->name('profile');
    Route::put('/profile', [EtudiantController::class, 'updateProfile'])->name('profile.update');
    Route::get('/cours', [EtudiantController::class, 'cours'])->name('cours');
    Route::get('/notes', [EtudiantController::class, 'notes'])->name('notes');
    Route::get('/devoirs', [EtudiantController::class, 'devoirs'])->name('devoirs');
});

// Route de redirection après connexion (fallback)
Route::get('/redirect', function() {
    $user = auth()->user();

    if (!$user->role) {
        auth()->logout();
        return redirect('/login')->withErrors(['email' => 'Aucun rôle assigné.']);
    }

    switch($user->role->name) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'enseignant':
            return redirect()->route('enseignant.dashboard');
        case 'etudiant':
            return redirect()->route('etudiant.dashboard');
        default:
            return redirect('/home');
    }
})->middleware('auth')->name('redirect');
