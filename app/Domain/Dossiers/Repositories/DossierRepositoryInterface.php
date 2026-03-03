<?php

namespace App\Domain\Dossiers\Repositories;

use App\Domain\Dossiers\Models\Dossier;

interface DossierRepositoryInterface
{
    public function getAll(int $perPage = 20);

    public function find(int $id);

    public function create(array $data): Dossier;

    public function update(Dossier $dossier, array $data): Dossier;

    public function delete(Dossier $dossier): bool;
}
