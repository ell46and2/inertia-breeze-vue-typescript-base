<?php

declare(strict_types=1);

use App\Actions\Auth\Profile\DeleteProfileAction;
use App\Models\User;

test('user can delete their account', function (): void {
    $user = User::factory()->create();

    $this->mock(DeleteProfileAction::class)
        ->shouldReceive('execute')
        ->withArgs(function (User $u) use ($user) {
            expect($u->is($user))->toBeTrue();

            return true;
        })
        ->once();

    $this
        ->actingAs($user)
        ->delete(route('profile.destroy'), [
            'password' => 'password',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
});

test('correct password must be provided to delete account', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->from(route('profile.edit'))
        ->delete(route('profile.destroy'), [
            'password' => 'wrong-password',
        ])
        ->assertSessionHasErrors('password')
        ->assertRedirect(route('profile.edit'));

    $this->assertNotNull($user->fresh());
});
