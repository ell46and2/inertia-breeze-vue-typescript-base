<?php

declare(strict_types=1);

namespace Tests\RequestFactories\Auth\Register;

use Worksome\RequestFactories\RequestFactory;

class RegisterStoreRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ];
    }
}
