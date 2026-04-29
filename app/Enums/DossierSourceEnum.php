<?php

namespace App\Enums;

enum DossierSourceEnum: string
{
    case CITOYEN = 'citoyen';
    case ADMINISTRATION = 'administration';
    case POLICE = 'police';
    case AUTRE = 'autre';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
