<?php

declare(strict_types=1);

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileDeleteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'password' => [
                'required',
                'current_password',
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
