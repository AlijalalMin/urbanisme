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

    public function getPaginatedList(int $perPage = 20)
    {
        return $this->repository->getAll($perPage);
    }

    public function createDossier(DossierData $data): Dossier
    {
        // If you had to send an email or log an event, it happens here.
        return $this->repository->create($data->toArray());
    }

    public function showDossier(int $id)
    {
        return $this->repository->find($id);
    }

    public function updateDossier(Dossier $dossier, array $data): Dossier
    {
        return $this->repository->update($dossier, $data);
    }

    public function archiveDossier(Dossier $dossier): bool
    {
        return $this->repository->delete($dossier);
    }
}
