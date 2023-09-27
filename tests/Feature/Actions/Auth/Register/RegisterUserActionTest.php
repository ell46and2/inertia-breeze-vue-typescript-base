<?php

declare(strict_types=1);

use App\Actions\Auth\Register\RegisterUserAction;
use App\Dto\Auth\Register\RegisterUserStoreData;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;

test('registers a new user', function (): void {
    $data = RegisterUserStoreData::from([
        'firstName' => 'Jane',
        'lastName' => 'Doe',
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    Event::fake();

    $result = app(RegisterUserAction::class)->execute($data);

    expect($result)->toBeInstanceOf(User::class)
        ->and($result->first_name)->toBe('Jane')
        ->and($result->last_name)->toBe('Doe')
        ->and($result->email)->toBe('test@example.com')
        ->and(Hash::check('password', $result->password))->toBeTrue();

    Event::assertDispatched(Registered::class, fn (Registered $event) => $event->user->is($result));
});
