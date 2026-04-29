<?php

namespace App\Domain\Dossiers\DTO;

use App\Http\Requests\Dossiers\StoreDossierRequest;

class DossierData
{
    public function __construct(
        public string $numero_dossier,
        public string $objet,
        public string $type_dossier,
        public string $priorite,
        public string $source_signalement,
        public string $statut,
        public ?string $plaignant,
        public ?string $accuse,
        public ?string $coordonnees_gps,
        public ?string $adresse_complete,
        public ?string $description_initiale,
        public ?string $date_arrive,
        public int $user_id,
        public ?int $annexe_id,
        public ?int $district_id
    ) {}

    public static function fromRequest(StoreDossierRequest $request): self
    {
        return new self(
            numero_dossier: $request->numero_dossier,
            objet: $request->objet,
            type_dossier: $request->type_dossier,
            priorite: $request->priorite,
            source_signalement: $request->source_signalement,
            statut: $request->statut,
            plaignant: $request->plaignant,
            accuse: $request->accuse,
            coordonnees_gps: $request->coordonnees_gps,
            adresse_complete: $request->adresse_complete,
            description_initiale: $request->description_initiale,
            date_arrive: $request->date_arrive,
            user_id: $request->user_id,
            annexe_id: $request->annexe_id,
            district_id: $request->district_id,
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
