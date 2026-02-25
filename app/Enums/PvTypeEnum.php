<?php

namespace App\Enums;

enum PvTypeEnum: string
{
    case CONSTAT = 'constat';
    case AUDITION = 'audition';
    case RAPPORT = 'rapport';
    case AUTRE = 'autre';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
