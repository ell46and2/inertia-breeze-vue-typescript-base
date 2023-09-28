<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\Password\Confirm;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class ConfirmablePasswordShowController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Auth/ConfirmPassword');
    }
}
