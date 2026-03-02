<?php

namespace App\Enums;

enum DossierStatutEnum: string
{
    case NOUVEAU = 'nouveau';
    case EN_COURS = 'en_cours';
    case CLOTURE = 'cloture';
    case ARCHIVE = 'archive';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
