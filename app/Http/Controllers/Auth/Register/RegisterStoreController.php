<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\Register;

use App\Actions\Auth\Register\RegisterUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Register\RegisterStoreRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RegisterStoreController extends Controller
{
    public function __invoke(RegisterStoreRequest $request, RegisterUserAction $registerUserAction): RedirectResponse
    {
        $user = $registerUserAction->execute($request->toDto());

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
