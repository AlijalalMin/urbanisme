<?php

namespace App\Enums;

enum DossierTypeEnum: string
{
    case PLAINTE = 'plainte';
    case SIGNALEMENT = 'signalement';
    case INFRACTION = 'infraction';
    case AUTRE = 'autre';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
