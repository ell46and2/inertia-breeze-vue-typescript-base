<?php

declare(strict_types=1);

test('login screen can be rendered', function (): void {
    $response = $this->get(route('login'));

    $response->assertStatus(200);
});
