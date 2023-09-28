<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth\Password\NewPassword;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class NewPasswordStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'token' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'confirmed',
                Password::defaults()
            ],
        ];
    }
}
