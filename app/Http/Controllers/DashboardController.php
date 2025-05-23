<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function redirectUser()
    {
        $user = auth()->user(); // ← هادي هي السطر المهم

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'etudiant') {
            return redirect()->route('etudiant.dashboard');
        } elseif ($user->role === 'enseignant') {
            return redirect()->route('enseignant.dashboard');
        }

        abort(403); // Pas autorisé
    }
}
