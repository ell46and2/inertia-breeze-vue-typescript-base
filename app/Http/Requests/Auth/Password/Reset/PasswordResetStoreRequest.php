<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth\Password\Reset;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
            ],
        ];
    }
}
