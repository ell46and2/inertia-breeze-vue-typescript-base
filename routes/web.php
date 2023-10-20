<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\Profile\ProfileDeleteController;
use App\Http\Controllers\Auth\Profile\ProfileEditController;
use App\Http\Controllers\Auth\Profile\ProfileUpdateController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', fn () => Inertia::render('Dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', ProfileEditController::class)
        ->name('profile.edit');

    Route::patch('/profile', ProfileUpdateController::class)
        ->name('profile.update');

    Route::delete('/profile', ProfileDeleteController::class)
        ->name('profile.destroy');

    Route::get('/users', function (Request $request) {
        $users = User::query()
            ->when($request->input('search'), function (Builder $query, string $search): void {
                $query->where('first_name', 'LIKE', '%' . $search . '%');
            })
            ->when($request->input('field'), function (Builder $query) use ($request): void {
                $query->orderBy(
                    $request->string('field')->toString(),
                    'desc' === $request->string('direction')->toString() ? 'desc' : 'asc'
                );
            })
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Users', [
            'users' => UserResource::collection($users),
            'filters' => $request->only(['search', 'column', 'direction'])
        ]);
    })->name('users.index');
});

require __DIR__ . '/auth.php';
