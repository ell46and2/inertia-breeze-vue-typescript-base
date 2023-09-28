<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\EmailVerification\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerification\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerification\VerifyEmailController;
use App\Http\Controllers\Auth\Login\LoginDestroyController;
use App\Http\Controllers\Auth\Login\LoginShowController;
use App\Http\Controllers\Auth\Login\LoginStoreController;
use App\Http\Controllers\Auth\Password\Confirm\ConfirmablePasswordShowController;
use App\Http\Controllers\Auth\Password\Confirm\ConfirmablePasswordStoreController;
use App\Http\Controllers\Auth\Password\NewPassword\NewPasswordCreateController;
use App\Http\Controllers\Auth\Password\NewPassword\NewPasswordStoreController;
use App\Http\Controllers\Auth\Password\PasswordUpdateController;
use App\Http\Controllers\Auth\Password\Reset\PasswordResetCreateController;
use App\Http\Controllers\Auth\Password\Reset\PasswordResetStoreController;
use App\Http\Controllers\Auth\Register\RegisterShowController;
use App\Http\Controllers\Auth\Register\RegisterStoreController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (): void {
    Route::get('register', RegisterShowController::class)
        ->name('register');

    Route::post('register', RegisterStoreController::class)
        ->name('register.store');

    Route::get('login', LoginShowController::class)
        ->name('login');

    Route::post('login', LoginStoreController::class)
        ->name('login.store');

    Route::get('forgot-password', PasswordResetCreateController::class)
        ->name('password.request');

    Route::post('forgot-password', PasswordResetStoreController::class)
        ->name('password.email');

    Route::get('reset-password/{token}', NewPasswordCreateController::class)
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordStoreController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function (): void {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', EmailVerificationNotificationController::class)
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', ConfirmablePasswordShowController::class)
        ->name('password.confirm.show');

    Route::post('confirm-password', ConfirmablePasswordStoreController::class)
        ->name('password.confirm.store');

    Route::put('password', PasswordUpdateController::class)
        ->name('password.update');

    Route::post('logout', LoginDestroyController::class)
        ->name('logout');
});
