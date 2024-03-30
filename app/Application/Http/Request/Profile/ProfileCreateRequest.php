<?php

declare(strict_types=1);

namespace App\Application\Http\Request\Profile;

use Hyperf\Validation\Request\FormRequest;

class ProfileCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'      => 'required',
            'username'  => 'required|unique:profiles',
            'avatar'    => 'nullable|image'
        ];
    }
}
