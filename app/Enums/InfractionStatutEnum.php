<?php

namespace App\Enums;

enum InfractionStatutEnum: string
{
    case NOUVELLE = 'nouvelle';
    case EN_TRAITEMENT = 'en_traitement';
    case VERIFIEE = 'verifiee';
    case CONSTATEE = 'constatee';
    case TRANSMISE = 'transmise';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
