<?php

namespace App\Domain\Dossiers\Services;

use App\Domain\Dossiers\DTO\DossierData;
use App\Domain\Dossiers\Models\Dossier;
use App\Domain\Dossiers\Repositories\DossierRepositoryInterface;

class DossierService
{
    public function __construct(
        protected DossierRepositoryInterface $repository
    ) {}

    public function create(DossierData $data): Dossier
    {
        return $this->repository->create($data->toArray());
    }

    public function update(Dossier $dossier, array $data): Dossier
    {
        return $this->repository->update($dossier, $data);
    }

    public function archive(Dossier $dossier): bool
    {
        return $this->repository->delete($dossier);
    }
}
