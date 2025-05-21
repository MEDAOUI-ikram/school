<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Assurez-vous que 'auth.login' est le bon chemin vers votre vue
    }

    /**
     * Traite la tentative de connexion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
{
    try {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            //'password' => ['required'],
        ]);

        Log::info('Tentative de connexion pour email: ' . $credentials['email']);
        Log::info('Données validées: ' . json_encode($credentials));

        $login_data = [
            'email' => $credentials['email'],
            'password' => $credentials['password']
        ];

        Log::info('Données pour Auth::attempt(): ' . json_encode($login_data));

        if (Auth::attempt($login_data)) {
            $request->session()->regenerate();
            Log::info('Connexion RÉUSSIE pour: ' . $request->email);
            return redirect()->intended('/dashboard');
        } else {
            Log::warning('Connexion ÉCHOUÉE pour: ' . $request->email);
        }

        return back()->withErrors([
            'email' => 'Identifiants invalides',
        ])->onlyInput('email');

    } catch (\Exception $e) {
        Log::error('Erreur lors de la connexion: ' . $e->getMessage());
        return back()->withErrors([
            'email' => 'Erreur lors de la connexion',
        ]);
    }
}

    /**
     * Déconnecte l'utilisateur.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/'); // Redirigez vers la page d'accueil
    }
}
