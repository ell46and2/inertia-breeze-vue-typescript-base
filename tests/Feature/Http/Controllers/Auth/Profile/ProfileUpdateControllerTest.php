<?php

declare(strict_types=1);

use App\Actions\Auth\Profile\UpdateProfileAction;
use App\Dto\Auth\Profile\ProfileUpdateData;
use App\Models\User;
use Tests\RequestFactories\Auth\Profile\ProfileUpdateRequestFactory;

test('user must be authenticated', function (): void {
    $this
        ->patch(route('profile.update'))
        ->assertRedirectToRoute('login');
});

test('requires valid data', function ($data, $errors): void {
    $existingUser = User::factory()->create(['email' => 'hello@test.com']);
    $user = User::factory()->create();

    $this->actingAs($user)
        ->patch(route('profile.update'), ProfileUpdateRequestFactory::new($data)->create())
        ->assertSessionHasErrors($errors);
})->with([
    'first name missing' => [['first_name' => null], ['first_name']],
    'last name missing' => [['last_name' => null], ['last_name']],
    'email missing' => [['email' => null], ['email']],
    'email not a valid email address' => [['email' => 'notvalid'], ['email']],
    'email already exists' => [['email' => 'hello@test.com'], ['email']],
]);

test('profile information can be updated', function (): void {
    $user = User::factory()->create();

    $patchData = [
        'first_name' => 'Jane',
        'last_name' => 'Doe',
        'email' => 'test@example.com',
    ];

    $this->mock(UpdateProfileAction::class)
        ->shouldReceive('execute')
        ->withArgs(function (User $u, ProfileUpdateData $dto) use ($patchData, $user) {
            expect($u->is($user))->toBeTrue()
                ->and($dto->toArray())->toEqual($patchData);

            return true;
        })
        ->once();

    $response = $this
        ->actingAs($user)
        ->patch(route('profile.update'), $patchData);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('profile.edit'));
});
