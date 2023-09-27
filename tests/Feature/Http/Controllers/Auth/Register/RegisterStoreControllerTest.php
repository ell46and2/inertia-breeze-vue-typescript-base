<?php

declare(strict_types=1);

use App\Actions\Auth\Register\RegisterUserAction;
use App\Dto\Auth\Register\RegisterUserStoreData;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Tests\RequestFactories\Auth\Register\RegisterStoreRequestFactory;

test('requires valid data', function ($data, $errors): void {
    $existingUser = User::factory()->create(['email' => 'hello@test.com']);

    $this->post(route('register.store'), RegisterStoreRequestFactory::new($data)->create())
        ->assertSessionHasErrors($errors);
})->with([
    'first name missing' => [['first_name' => null], ['first_name']],
    'last name missing' => [['last_name' => null], ['last_name']],
    'email missing' => [['email' => null], ['email']],
    'email not a valid email address' => [['email' => 'notvalid'], ['email']],
    'email already exists' => [['email' => 'hello@test.com'], ['email']],
    'password missing' => [['password' => null], ['password']],
    'password confirmation missing' => [['password_confirmation' => null], ['password']],
    'password confirmation doesnt match' => [['password' => 'Password123!' ,'password_confirmation' => 'Password1234!'], ['password']],
]);

test('new users can register', function (): void {
    $postData = [
        'first_name' => 'Jane',
        'last_name' => 'Doe,',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    $this->mock(RegisterUserAction::class)
        ->shouldReceive('execute')
        ->withArgs(function (RegisterUserStoreData $data) use ($postData) {
            $dtoData = array_filter($postData, fn ($key) => 'password_confirmation' !== $key, ARRAY_FILTER_USE_KEY);

            expect($data->toArray())->toEqual($dtoData);

            return true;
        })
        ->once()
        ->andReturn(User::factory()->create());

    $response = $this->post(route('register.store'), $postData);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});
