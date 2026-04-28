<?php

namespace App\Domain\Infractions\Models;

use App\Domain\Dossiers\Models\Dossier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Infraction extends Model
{
    use SoftDeletes;

    protected $table = 'infractions';

    protected $fillable = [
        'numero_infraction',
        'date_constatation',
        'localisation_precise',
        'niveau_gravite',
        'statut_infraction',
        'dossier_id',
    ];

    protected $casts = [
        'date_constatation' => 'datetime',
        'niveau_gravite' => 'integer',
    ];

    public function dossier()
    {
        return $this->belongsTo(Dossier::class, 'dossier_id');
    }
}
