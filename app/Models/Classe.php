<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_classe',
        'annee',
        'niveau_id', // Don't forget this!
    ];

    public function etudiants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'classe_etudiants')->withPivot('nom_groupe')->withTimestamps();
    }

    public function enseignants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'classe_enseignants')->withTimestamps();
    }

    public function matieres(): BelongsToMany
    {
        return $this->belongsToMany(Matiere::class, 'classe_enseignants')->withTimestamps();
    }

    public function emploiDuTemps(): HasMany
    {
        return $this->hasMany(EmploiDuTemps::class);
    }

    public function niveau() // Relationship to Niveau
    {
        return $this->belongsTo(Niveau::class);
    }
}
