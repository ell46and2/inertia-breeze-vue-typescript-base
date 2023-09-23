<?php

declare(strict_types=1);

use App\Actions\Auth\RegisterUserAction;
use App\Dto\Auth\RegisterUserStoreData;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;

test('registers a new user', function (): void {
    $data = RegisterUserStoreData::from([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    Event::fake();

    $result = app(RegisterUserAction::class)->execute($data);

    expect($result)->toBeInstanceOf(User::class)
        ->and($result->name)->toBe('Test User')
        ->and($result->email)->toBe('test@example.com')
        ->and(Hash::check('password', $result->password))->toBeTrue();

    Event::assertDispatched(Registered::class, fn (Registered $event) => $event->user->is($result));
});
