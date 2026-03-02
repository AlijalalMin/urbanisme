<?php

namespace App\Domain\Dossiers\Actions;

use App\Domain\Dossiers\DTO\DossierData;
use App\Domain\Dossiers\Services\DossierService;

class CreateDossierAction
{
    public function __construct(
        protected DossierService $service
    ) {}

    public function handle(DossierData $data)
    {
        return $this->service->create($data);
    }
}
