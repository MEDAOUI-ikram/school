<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Affiche le formulaire d'inscription.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Traite la requête d'inscription.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'courriel' => 'required|string|email|max:255|unique:users,email',
            'mot_de_passe' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,enseignant,etudiant',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->nom, // This should likely be 'name'
            'email' => $request->courriel, // This should likely be 'email'
            'password' => Hash::make($request->mot_de_passe),
            'role' => $request->role,
            // ... other fields
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Inscription réussie !');
    }

    /**
     * Affiche le formulaire de connexion.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Traite la requête de connexion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Adresse e-mail ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    /**
     * Traite la requête de déconnexion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Affiche le tableau de bord de l'administrateur.
     *
     * @return \Illuminate\View\View
     */
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Affiche le tableau de bord de l'enseignant.
     *
     * @return \Illuminate\View\View
     */
    public function enseignantDashboard()
    {
        return view('enseignant.dashboard');
    }

    /**
     * Affiche le tableau de bord de l'étudiant.
     *
     * @return \Illuminate\View\View
     */
    public function etudiantDashboard()
    {
        return view('etudiant.dashboard');
    }
}
