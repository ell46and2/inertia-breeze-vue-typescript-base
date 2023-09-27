<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth\Register;

use App\Dto\Auth\Register\RegisterUserStoreData;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterStoreRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'string',
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:' . User::class,
            ],
            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function toDto(): RegisterUserStoreData
    {
        return new RegisterUserStoreData(
            firstName: $this->string('first_name')->toString(),
            lastName: $this->string('last_name')->toString(),
            email: $this->string('email')->toString(),
            password: $this->string('password')->toString(),
        );
    }
}
