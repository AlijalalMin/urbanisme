<?php

namespace App\Domain\Infractions\Services;

use App\Domain\Infractions\DTO\InfractionData;
use App\Domain\Infractions\Models\Infraction;
use App\Domain\Infractions\Repositories\InfractionRepositoryInterface;

class InfractionService
{
    public function __construct(
        protected InfractionRepositoryInterface $repository
    ) {}

    public function getPaginatedList(array $filters = [], int $perPage = 20)
    {
        return $this->repository->getAll($perPage, $filters);
    }

    public function createInfraction(InfractionData $data): Infraction
    {
        return $this->repository->create($data->toArray());
    }

    public function showInfraction(int $id)
    {
        return $this->repository->find($id);
    }

    public function updateInfraction(Infraction $infraction, array $data): Infraction
    {
        return $this->repository->update($infraction, $data);
    }

    public function deleteInfraction(Infraction $infraction): bool
    {
        return $this->repository->delete($infraction);
    }
}
