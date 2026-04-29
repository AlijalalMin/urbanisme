<?php

namespace App\Domain\Dossiers\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dossier extends Model
{
    use SoftDeletes;

    protected $table = 'dossiers';

    protected $fillable = [
        'numero_dossier',
        'objet',
        'type_dossier',
        'priorite',
        'source_signalement',
        'plaignant',
        'accuse',
        'date_arrive',
        'statut',
        'coordonnees_gps',
        'adresse_complete',
        'description_initiale',
        'user_id',
        'annexe_id',
        'district_id',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function district()
    {
        return $this->belongsTo(\App\Domain\Districts\Models\District::class);
    }

    public function annexe()
    {
        return $this->belongsTo(\App\Domain\Annexes\Models\Annexe::class);
    }

    public function infractions()
    {
        return $this->hasMany(\App\Domain\Infractions\Models\Infraction::class, 'dossier_id');
    }

    public function requerants()
    {
        return $this->belongsToMany(\App\Domain\Requerants\Models\Requerant::class, 'dossier_requerant')
            ->withPivot(['role', 'commentaire'])
            ->withTimestamps();
    }

    public function auteurs()
    {
        return $this->belongsToMany(\App\Domain\Auteurs\Models\AuteurInfraction::class, 'dossier_auteur', 'dossier_id', 'auteur_id')
            ->withPivot(['role_auteur', 'commentaire'])
            ->withTimestamps();
    }

    public function mesures()
    {
        return $this->hasMany(\App\Domain\Mesures\Models\MesureDossier::class, 'dossier_id');
    }

    public function reponses()
    {
        return $this->hasMany(\App\Domain\Reponses\Models\ReponseAutorite::class, 'dossier_id');
    }
}
