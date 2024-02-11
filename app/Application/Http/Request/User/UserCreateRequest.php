<?php

declare(strict_types=1);

namespace Application\Http\Request\User;

use Hyperf\Validation\Request\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'  => 'required|max:200',
            'email' => 'required|email|unique:users',
        ];
    }
}
