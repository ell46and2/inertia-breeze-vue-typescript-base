<?php

declare(strict_types=1);

namespace Tests\RequestFactories\Auth\Profile;

use Worksome\RequestFactories\RequestFactory;

class ProfileUpdateRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
