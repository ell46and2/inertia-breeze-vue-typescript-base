<?php

declare(strict_types=1);

use App\Models\User;

test('unauthenticated users are redirected to login', function (): void {
    $response = $this->post(route('logout'));

    $response->assertRedirect(route('login'));
});

test('users can logout', function (): void {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('logout'));

    $this->assertGuest();
    $response->assertRedirect('/');
});
