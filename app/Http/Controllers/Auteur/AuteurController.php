<?php

namespace App\Http\Controllers\Auteur;

use App\Domain\Auteurs\Services\AuteurService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuteurController extends Controller
{
    public function __construct(
        protected AuteurService $auteurService
    ) {}

    public function store(Request $request, $dossierId)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'cin' => 'nullable|string|max:20',
            'statut_professionnel' => 'nullable|string',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'raison_sociale' => 'nullable|string|max:255',
            'ice' => 'nullable|string|max:255',
            'role_auteur' => 'nullable|string',
            'commentaire' => 'nullable|string',
        ]);

        $this->auteurService->createAuteurForDossier($validated, (int) $dossierId);

        return redirect()->back()->with('success', 'Auteur d\'infraction identifié avec succès');
    }
}
