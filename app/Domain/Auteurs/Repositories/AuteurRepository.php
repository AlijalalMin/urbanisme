<?php

namespace App\Domain\Auteurs\Repositories;

use App\Domain\Auteurs\Models\AuteurInfraction;
use Illuminate\Pagination\LengthAwarePaginator;

class AuteurRepository implements AuteurRepositoryInterface
{
    public function getAll(int $perPage = 20): LengthAwarePaginator
    {
        return AuteurInfraction::paginate($perPage);
    }

    public function find(int $id): ?AuteurInfraction
    {
        return AuteurInfraction::find($id);
    }

    public function create(array $data): AuteurInfraction
    {
        return AuteurInfraction::create($data);
    }

    public function update(AuteurInfraction $auteur, array $data): AuteurInfraction
    {
        $auteur->update($data);
        return $auteur;
    }

    public function delete(AuteurInfraction $auteur): bool
    {
        return $auteur->delete();
    }

    public function attachToDossier(int $auteurId, int $dossierId, array $pivotData = []): void
    {
        $auteur = $this->find($auteurId);
        if ($auteur) {
            $auteur->dossiers()->syncWithoutDetaching([$dossierId => $pivotData]);
        }
    }
}
