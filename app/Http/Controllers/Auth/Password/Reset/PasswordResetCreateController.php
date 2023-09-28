<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\Password\Reset;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class PasswordResetCreateController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }
}
