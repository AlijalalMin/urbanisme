<?php

namespace App\Http\Requests\Dossiers;

use Illuminate\Foundation\Http\FormRequest;

class StoreDossierRequest extends FormRequest
{
    public function rules()
    {
        return [
            'numero_dossier' => 'required|string|unique:dossiers,numero_dossier',
            'objet' => 'required|string',
            'type_dossier' => 'required|string',
            'priorite' => 'required|string',
            'source_signalement' => 'required|string',
            'statut' => 'required|string',
            'plaignant' => 'nullable|string',
            'accuse' => 'nullable|string',
            'coordonnees_gps' => 'nullable|string',
            'adresse_complete' => 'nullable|string',
            'description_initiale' => 'nullable|string',
            'date_arrive' => 'required|date',
            'user_id' => 'required|integer|exists:users,id',
            'annexe_id' => 'nullable|integer|exists:annexes,id',
            'district_id' => 'nullable|integer|exists:districts,id',
        ];
    }
}
