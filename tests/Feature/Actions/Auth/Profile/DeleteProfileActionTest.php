<?php

declare(strict_types=1);

use App\Actions\Auth\Profile\DeleteProfileAction;
use App\Models\User;

test('deletes a user', function (): void {
    $user = User::factory()->create();

    app(DeleteProfileAction::class)->execute($user);

    $this->assertSoftDeleted($user);
});
