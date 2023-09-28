<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\EmailVerification;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;

class EmailVerificationNotificationController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        if (authenticatedUser()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        authenticatedUser()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
