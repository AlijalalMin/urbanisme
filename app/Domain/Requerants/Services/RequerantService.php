<?php

namespace App\Domain\Requerants\Services;

use App\Domain\Requerants\Models\Requerant;
use App\Domain\Requerants\Repositories\RequerantRepositoryInterface;

class RequerantService
{
    public function __construct(
        protected RequerantRepositoryInterface $repository
    ) {}

    public function createRequerantForDossier(array $data, int $dossierId): Requerant
    {
        $requerantData = [
            'nom' => $data['nom'] ?? null,
            'cin' => $data['cin'] ?? null,
            'contact' => $data['contact'] ?? null,
            'adresse' => $data['adresse'] ?? null,
            'type_requerant' => $data['type_requerant'] ?? null,
            'ice' => $data['ice'] ?? null,
        ];

        $requerant = $this->repository->create($requerantData);

        $pivotData = [
            'role' => $data['role'] ?? 'requerant',
            'commentaire' => $data['commentaire'] ?? null,
        ];

        $this->repository->attachToDossier($requerant->id, $dossierId, $pivotData);

        return $requerant;
    }

    public function updateRequerant(Requerant $requerant, array $data): Requerant
    {
        return $this->repository->update($requerant, $data);
    }
}
