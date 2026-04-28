<?php

namespace App\Http\Requests\Infractions;

use Illuminate\Foundation\Http\FormRequest;

class StoreInfractionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'numero_infraction' => 'required|string|unique:infractions,numero_infraction',
            'date_constatation' => 'required|date',
            'localisation_precise' => 'required|string',
            'niveau_gravite' => 'required|integer',
            'statut_infraction' => 'required|string',
            'dossier_id' => 'required|integer|exists:dossiers,id',
        ];
    }
}
