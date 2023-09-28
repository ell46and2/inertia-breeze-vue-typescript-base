<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\Password\NewPassword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class NewPasswordCreateController extends Controller
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render('Auth/ResetPassword', [
            'email' => $request->string('email')->toString(),
            'token' => $request->route('token'),
        ]);
    }
}
