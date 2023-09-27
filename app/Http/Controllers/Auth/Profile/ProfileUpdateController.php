<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\Profile;

use App\Actions\Auth\Profile\UpdateProfileAction;
use App\Actions\Notification\FlashNotificationAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ProfileUpdateController extends Controller
{
    public function __invoke(ProfileUpdateRequest $request, UpdateProfileAction $updateProfileAction, FlashNotificationAction $flashNotificationAction): RedirectResponse
    {
        $updateProfileAction->execute(authenticatedUser(), $request->toDto());

        $flashNotificationAction->success('Profile updated');

        return Redirect::route('profile.edit');
    }
}
