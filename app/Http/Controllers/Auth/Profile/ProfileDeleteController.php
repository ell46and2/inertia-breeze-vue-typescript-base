<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\Profile;

use App\Actions\Auth\Profile\DeleteProfileAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfileDeleteRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileDeleteController extends Controller
{
    public function __invoke(ProfileDeleteRequest $request, DeleteProfileAction $deleteProfileAction): RedirectResponse
    {
        $user = authenticatedUser();

        Auth::logout();

        $deleteProfileAction->execute($user);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
