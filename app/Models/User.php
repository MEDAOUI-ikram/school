<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the role that owns the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole($role)
    {
        return $this->role && $this->role->name === $role;
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Check if user is teacher
     */
    public function isEnseignant()
    {
        return $this->hasRole('enseignant');
    }

    /**
     * Check if user is student
     */
    public function isEtudiant()
    {
        return $this->hasRole('etudiant');
    }


    public function classesEnseignees(): BelongsToMany  // Renamed for clarity
    {
        return $this->belongsToMany(Classe::class, 'classe_enseignants')->withTimestamps();
    }

    public function matieresEnseignees(): BelongsToMany // Renamed for clarity
    {
        return $this->belongsToMany(Matiere::class, 'classe_enseignants')->withTimestamps();
    }

    public function classesEtudiees(): BelongsToMany // Renamed for clarity
    {
        return $this->belongsToMany(Classe::class, 'classe_etudiants')->withPivot('nom_groupe')->withTimestamps();
    }
}
