<?php

declare(strict_types=1);

namespace App\Enum;

enum NotificationType: string
{
    case SUCCESS = 'success';
    case ERROR = 'error';
    case WARNING = 'warning';

    public static function getValues(): array
    {
        return [
            self::SUCCESS->value,
            self::ERROR->value,
            self::WARNING->value,
        ];
    }
}
