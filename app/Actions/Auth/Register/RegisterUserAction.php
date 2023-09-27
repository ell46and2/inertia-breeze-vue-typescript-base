<?php

declare(strict_types=1);

namespace App\Actions\Auth\Register;

use App\Dto\Auth\Register\RegisterUserStoreData;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterUserAction
{
    public function execute(RegisterUserStoreData $data): User
    {
        $user = User::query()->create($data->toArray());

        event(new Registered($user));

        return $user;
    }
}
