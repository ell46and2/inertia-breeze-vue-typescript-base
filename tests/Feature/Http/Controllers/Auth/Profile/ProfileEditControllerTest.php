<?php

declare(strict_types=1);

use App\Models\User;

test('user must be authenticated', function (): void {
    $this
        ->get(route('profile.edit'))
        ->assertRedirectToRoute('login');
});

test('profile page is displayed', function (): void {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('profile.edit'));

    $response->assertOk();
});
