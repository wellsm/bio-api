<?php

declare(strict_types=1);

namespace Application\Http\Request\Password;

use Hyperf\Validation\Request\FormRequest;

class PasswordSetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token'    => 'required|size:7',
            'password' => 'required|confirmed|min:6|max:20',
        ];
    }
}
