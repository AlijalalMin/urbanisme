<?php

namespace App\Domain\Auteurs\Models;

use App\Domain\Dossiers\Models\Dossier;
use App\Enums\AuteurInfractionTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AuteurInfraction extends Model
{
    use SoftDeletes;

    protected $table = 'auteur_infractions';

    protected $fillable = [
        'nom',
        'prenom',
        'cin',
        'statut_professionnel',
        'telephone',
        'adresse',
        'ville',
        'raison_sociale',
        'ice',
    ];

    protected $casts = [
        'statut_professionnel' => AuteurInfractionTypeEnum::class,
    ];

    /**
     * The dossiers associated with the auteur.
     */
    public function dossiers(): BelongsToMany
    {
        return $this->belongsToMany(Dossier::class, 'dossier_auteur', 'auteur_id', 'dossier_id')
            ->withPivot(['role_auteur', 'commentaire'])
            ->withTimestamps();
    }
}
