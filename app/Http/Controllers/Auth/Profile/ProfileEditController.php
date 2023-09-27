<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Inertia\Inertia;
use Inertia\Response;

class ProfileEditController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => authenticatedUser() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }
}
