<?php

namespace App\Domain\Dossiers\Actions;

use App\Domain\Dossiers\Models\Dossier;
use App\Domain\Dossiers\Services\DossierService;

class UpdateDossierAction
{
    public function __construct(
        protected DossierService $service
    ) {}

    public function handle(Dossier $dossier, array $data)
    {
        return $this->service->update($dossier, $data);
    }
}
