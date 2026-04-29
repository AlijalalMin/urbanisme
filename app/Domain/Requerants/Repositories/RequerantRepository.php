<?php

namespace App\Domain\Requerants\Repositories;

use App\Domain\Requerants\Models\Requerant;
use Illuminate\Pagination\LengthAwarePaginator;

class RequerantRepository implements RequerantRepositoryInterface
{
    public function getAll(int $perPage = 20): LengthAwarePaginator
    {
        return Requerant::paginate($perPage);
    }

    public function find(int $id): ?Requerant
    {
        return Requerant::find($id);
    }

    public function create(array $data): Requerant
    {
        return Requerant::create($data);
    }

    public function update(Requerant $requerant, array $data): Requerant
    {
        $requerant->update($data);
        return $requerant;
    }

    public function delete(Requerant $requerant): bool
    {
        return $requerant->delete();
    }

    public function attachToDossier(int $requerantId, int $dossierId, array $pivotData = []): void
    {
        $requerant = $this->find($requerantId);
        if ($requerant) {
            $requerant->dossiers()->syncWithoutDetaching([$dossierId => $pivotData]);
        }
    }
}
