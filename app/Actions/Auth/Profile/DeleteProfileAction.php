<?php

declare(strict_types=1);

namespace App\Actions\Auth\Profile;

use App\Models\User;

class DeleteProfileAction
{
    public function execute(User $user): void
    {
        $user->delete();
    }
}
