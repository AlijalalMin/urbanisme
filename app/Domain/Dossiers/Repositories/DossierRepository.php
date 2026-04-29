<?php

namespace App\Domain\Dossiers\Repositories;

use App\Domain\Dossiers\Models\Dossier;

class DossierRepository implements DossierRepositoryInterface
{
    public function getAll(int $perPage = 20, array $filters = [])
    {
        $query = Dossier::with(['user', 'annexe', 'district', 'infractions', 'requerants', 'auteurs'])->latest();

        if (! empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('numero_dossier', 'like', "%{$search}%")
                    ->orWhere('objet', 'like', "%{$search}%")
                    ->orWhere('description_initiale', 'like', "%{$search}%")
                    ->orWhere('plaignant', 'like', "%{$search}%");
            });
        }

        if (! empty($filters['status'])) {
            $query->where('statut', $filters['status']);
        }

        return $query->paginate($perPage);
    }

    public function find(int $id)
    {
        return Dossier::with(['user', 'annexe', 'district', 'infractions', 'requerants', 'auteurs'])->find($id);
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
