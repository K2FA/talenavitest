<?php

namespace App\Enums\Enums;

enum TodoPriority: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
