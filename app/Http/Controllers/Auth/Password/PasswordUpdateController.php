<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\Password;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Password\PasswordUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordUpdateController extends Controller
{
    /**
     * Update the user's password.
     */
    public function __invoke(PasswordUpdateRequest $request): RedirectResponse
    {
        authenticatedUser()->update([
            'password' => Hash::make($request->string('password')->toString()),
        ]);

        return back();
    }
}
