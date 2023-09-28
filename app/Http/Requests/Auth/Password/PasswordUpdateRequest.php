<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth\Password;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class PasswordUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'current_password' => [
                'required',
                'current_password'
            ],
            'password' => [
                'required',
                Password::defaults(),
                'confirmed'
            ],
        ];
    }
}
