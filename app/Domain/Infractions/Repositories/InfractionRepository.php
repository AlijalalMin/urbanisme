<?php

namespace App\Domain\Infractions\Repositories;

use App\Domain\Infractions\Models\Infraction;

class InfractionRepository implements InfractionRepositoryInterface
{
    public function getAll(int $perPage = 20, array $filters = [])
    {
        $query = Infraction::with('dossier')->latest();

        if (! empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('numero_infraction', 'like', "%{$search}%")
                    ->orWhere('localisation_precise', 'like', "%{$search}%");
            });
        }

        if (! empty($filters['dossier_id'])) {
            $query->where('dossier_id', $filters['dossier_id']);
        }

        return $query->paginate($perPage);
    }

    public function find(int $id)
    {
        return Infraction::with('dossier')->find($id);
    }

    public function create(array $data): Infraction
    {
        return Infraction::create($data);
    }

    public function update(Infraction $infraction, array $data): Infraction
    {
        $infraction->update($data);

        return $infraction;
    }

    public function delete(Infraction $infraction): bool
    {
        return $infraction->delete();
    }
}
