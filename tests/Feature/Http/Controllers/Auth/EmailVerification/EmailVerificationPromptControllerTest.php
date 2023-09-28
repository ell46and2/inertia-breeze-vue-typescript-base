<?php

declare(strict_types=1);

use App\Models\User;

test('email verification screen can be rendered', function (): void {
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    $response = $this->actingAs($user)->get('/verify-email');

    $response->assertStatus(200);
});
