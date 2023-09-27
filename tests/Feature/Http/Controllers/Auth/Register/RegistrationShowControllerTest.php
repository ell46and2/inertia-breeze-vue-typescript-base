<?php

declare(strict_types=1);

use Inertia\Testing\AssertableInertia;

test('registration screen can be rendered', function (): void {
    $this->get(route('register'))
        ->assertInertia(
            fn (AssertableInertia $page) => $page->component('Auth/Register')
        );
});
