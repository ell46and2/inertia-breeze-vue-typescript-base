<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\Password\Confirm;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ConfirmablePasswordStoreController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        if ( ! Auth::guard('web')->validate([
            'email' => authenticatedUser()->email,
            'password' => $request->string('password')->toString(),
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
