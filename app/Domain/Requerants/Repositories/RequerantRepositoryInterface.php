<?php

namespace App\Domain\Requerants\Repositories;

use App\Domain\Requerants\Models\Requerant;
use Illuminate\Pagination\LengthAwarePaginator;

interface RequerantRepositoryInterface
{
    public function getAll(int $perPage = 20): LengthAwarePaginator;
    public function find(int $id): ?Requerant;
    public function create(array $data): Requerant;
    public function update(Requerant $requerant, array $data): Requerant;
    public function delete(Requerant $requerant): bool;
    public function attachToDossier(int $requerantId, int $dossierId, array $pivotData = []): void;
}
