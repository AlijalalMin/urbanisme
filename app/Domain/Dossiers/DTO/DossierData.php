<?php

namespace App\Domain\Dossiers\DTO;

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
        public ?int $annexe_id
    ) {}

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
