<?php

declare(strict_types=1);

namespace Application\Http\Request\User;

use Hyperf\Validation\Request\FormRequest;

class UserAuthRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'    => 'required|email',
            'password' => 'required|string|min:6|max:20',
        ];
    }
}
