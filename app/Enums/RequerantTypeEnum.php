<?php

namespace App\Enums;

enum RequerantTypeEnum: string
{
    case PERSONNE = 'personne';
    case SOCIETE = 'societe';
    case ADMINISTRATION = 'administration';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
