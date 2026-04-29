<?php

namespace App\Domain\Auteurs\Repositories;

use App\Domain\Auteurs\Models\AuteurInfraction;
use Illuminate\Pagination\LengthAwarePaginator;

interface AuteurRepositoryInterface
{
    public function getAll(int $perPage = 20): LengthAwarePaginator;
    public function find(int $id): ?AuteurInfraction;
    public function create(array $data): AuteurInfraction;
    public function update(AuteurInfraction $auteur, array $data): AuteurInfraction;
    public function delete(AuteurInfraction $auteur): bool;
    public function attachToDossier(int $auteurId, int $dossierId, array $pivotData = []): void;
}
