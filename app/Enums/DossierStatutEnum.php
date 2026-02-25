<?php

namespace App\Enums;

enum DossierStatutEnum: string
{
    case NOUVEAU = 'nouveau';
    case EN_COURS = 'en_cours';
    case TRAITE = 'traite';
    case CLOS = 'clos';
    case REJETE = 'rejete';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
