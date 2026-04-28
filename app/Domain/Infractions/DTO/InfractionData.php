<?php

namespace App\Domain\Infractions\DTO;

use App\Http\Requests\Infractions\StoreInfractionRequest;

class InfractionData
{
    public function __construct(
        public string $numero_infraction,
        public string $date_constatation,
        public string $localisation_precise,
        public int $niveau_gravite,
        public string $statut_infraction,
        public int $dossier_id
    ) {}

    public static function fromRequest(StoreInfractionRequest $request): self
    {
        return new self(
            numero_infraction: $request->numero_infraction,
            date_constatation: $request->date_constatation,
            localisation_precise: $request->localisation_precise,
            niveau_gravite: $request->niveau_gravite,
            statut_infraction: $request->statut_infraction,
            dossier_id: $request->dossier_id
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
