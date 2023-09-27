<?php

declare(strict_types=1);

namespace App\Http\Requests\Profile;

use App\Dto\Auth\Profile\ProfileUpdateData;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'string',
                'max:255'
            ],
            'last_name' => [
                'string',
                'max:255'
            ],
            'email' => [
                'email',
                'max:255',
                Rule::unique(User::class)->ignore(authenticatedUser()->id)
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function toDto(): ProfileUpdateData
    {
        return new ProfileUpdateData(
            firstName: $this->string('first_name')->toString(),
            lastName: $this->string('last_name')->toString(),
            email: $this->string('email')->toString(),
        );
    }
}
