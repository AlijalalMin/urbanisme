<?php

namespace App\Domain\Dossiers\Actions;

use App\Domain\Dossiers\Models\Dossier;
use App\Domain\Dossiers\Services\DossierService;

class ArchiveDossierAction
{
    public function __construct(
        protected DossierService $service
    ) {}

    public function handle(Dossier $dossier)
    {
        return $this->service->archive($dossier);
    }
}
