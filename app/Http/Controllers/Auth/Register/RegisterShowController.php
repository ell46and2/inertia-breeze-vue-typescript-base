<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class RegisterShowController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Auth/Register');
    }
}
