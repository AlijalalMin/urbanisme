<?php

namespace App\Domain\Infractions\Repositories;

use App\Domain\Infractions\Models\Infraction;

interface InfractionRepositoryInterface
{
    public function getAll(int $perPage = 20, array $filters = []);

    public function find(int $id);

    public function create(array $data): Infraction;

    public function update(Infraction $infraction, array $data): Infraction;

    public function delete(Infraction $infraction): bool;
}
