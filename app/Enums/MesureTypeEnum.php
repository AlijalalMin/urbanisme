<?php

namespace App\Enums;

enum MesureTypeEnum: string
{
    case MISE_EN_DEMEURE = 'mise_en_demeure';
    case SUSPENSION = 'suspension';
    case AMENDE = 'amende';
    case AUTRE = 'autre';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
