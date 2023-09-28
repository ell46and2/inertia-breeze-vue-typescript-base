<?php

declare(strict_types=1);


test('reset password link screen can be rendered', function (): void {
    $response = $this->get(route('password.request'));

    $response->assertStatus(200);
});
