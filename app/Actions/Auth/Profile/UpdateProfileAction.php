<?php

declare(strict_types=1);

namespace App\Actions\Auth\Profile;

use App\Dto\Auth\Profile\ProfileUpdateData;
use App\Models\User;

class UpdateProfileAction
{
    public function execute(User $user, ProfileUpdateData $data): User
    {
        $user->fill($data->toArray());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return $user;
    }
}
