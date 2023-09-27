<?php

declare(strict_types=1);

use App\Actions\Auth\Profile\UpdateProfileAction;
use App\Dto\Auth\Profile\ProfileUpdateData;
use App\Models\User;

test('updates a users profile', function (): void {
    $user = User::factory()->create();

    $data = ProfileUpdateData::from([
        'firstName' => 'Jane',
        'lastName' => 'Doe',
        'email' => 'test@example.com',
    ]);

    $result = app(UpdateProfileAction::class)->execute($user, $data);

    expect($result)->toBeInstanceOf(User::class)
        ->and($result->first_name)->toBe('Jane')
        ->and($result->last_name)->toBe('Doe')
        ->and($result->email)->toBe('test@example.com')
        ->and($result->email_verified_at)->toBeNull();
});

test('email verification status is unchanged when the email address is unchanged', function (): void {
    $user = User::factory()->create();

    $data = ProfileUpdateData::from([
        'firstName' => 'Jane',
        'lastName' => 'Doe',
        'email' => $user->email,
    ]);

    $result = app(UpdateProfileAction::class)->execute($user, $data);

    expect($result)->toBeInstanceOf(User::class)
        ->and($result->first_name)->toBe('Jane')
        ->and($result->last_name)->toBe('Doe')
        ->and($result->email)->toBe($user->email)
        ->and($result->email_verified_at)->not()->toBeNull();
});
