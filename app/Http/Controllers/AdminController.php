<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_etudiants' => User::whereHas('role', function($q) {
                $q->where('name', 'etudiant');
            })->count(),
            'total_enseignants' => User::whereHas('role', function($q) {
                $q->where('name', 'enseignant');
            })->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::with('role')->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function createUser()
    {
        $roles = Role::all();
        return view('admin.create-user', compact('roles'));
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users')->with('success', 'Utilisateur créé avec succès!');
    }
}
