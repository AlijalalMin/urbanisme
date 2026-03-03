<?php

namespace App\Domain\Dossiers\Repositories;

use App\Domain\Dossiers\Models\Dossier;

class DossierRepository implements DossierRepositoryInterface
{
    public function getAll(int $perPage = 20)
    {
        return Dossier::with(['user', 'annexe'])->latest()->paginate($perPage);
    }

    public function find(int $id)
    {
        return Dossier::with(['user', 'annexe'])->find($id);
    }

    public function create(array $data): Dossier
    {
        return Dossier::create($data);
    }

    public function update(Dossier $dossier, array $data): Dossier
    {
        $dossier->update($data);

        return $dossier;
    }

    public function delete(Dossier $dossier): bool
    {
        return $dossier->delete();
    }
}
