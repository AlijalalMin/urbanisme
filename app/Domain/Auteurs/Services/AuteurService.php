<?php

namespace App\Domain\Auteurs\Services;

use App\Domain\Auteurs\Models\AuteurInfraction;
use App\Domain\Auteurs\Repositories\AuteurRepositoryInterface;

class AuteurService
{
    public function __construct(
        protected AuteurRepositoryInterface $repository
    ) {}

    public function createAuteurForDossier(array $data, int $dossierId): AuteurInfraction
    {
        $auteurData = [
            'nom' => $data['nom'] ?? null,
            'prenom' => $data['prenom'] ?? null,
            'cin' => $data['cin'] ?? null,
            'statut_professionnel' => $data['statut_professionnel'] ?? null,
            'telephone' => $data['telephone'] ?? null,
            'adresse' => $data['adresse'] ?? null,
            'ville' => $data['ville'] ?? null,
            'raison_sociale' => $data['raison_sociale'] ?? null,
            'ice' => $data['ice'] ?? null,
        ];

        $auteur = $this->repository->create($auteurData);

        $pivotData = [
            'role_auteur' => $data['role_auteur'] ?? 'auteur',
            'commentaire' => $data['commentaire'] ?? null,
        ];

        $this->repository->attachToDossier($auteur->id, $dossierId, $pivotData);

        return $auteur;
    }

    public function updateAuteur(AuteurInfraction $auteur, array $data): AuteurInfraction
    {
        return $this->repository->update($auteur, $data);
    }
}
