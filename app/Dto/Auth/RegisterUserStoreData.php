<?php

declare(strict_types=1);

namespace App\Dto\Auth;

use Spatie\LaravelData\Data;

class RegisterUserStoreData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {
    }
}
