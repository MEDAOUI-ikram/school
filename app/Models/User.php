<?php

namespace App\Models;



use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Add this line
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nom',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
