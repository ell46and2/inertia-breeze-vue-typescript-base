<?php

declare(strict_types=1);

namespace App\Dto\Auth\Register;

use Illuminate\Support\Arr;
use Spatie\LaravelData\Data;

class RegisterUserStoreData extends Data
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email,
        public readonly string $password,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $array = parent::toArray();

        Arr::forget($array, ['firstName', 'lastName']);

        /** @var array<string, mixed> $data */
        $data = [
            ...$array,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
        ];

        return $data;
    }
}
