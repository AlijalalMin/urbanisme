<?php

namespace App\Enums;

enum AuteurInfractionTypeEnum: string
{
    case PERSONNE = 'personne';
    case ENTREPRISE = 'entreprise';
    case AGENT_PUBLIC = 'agent_public';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
