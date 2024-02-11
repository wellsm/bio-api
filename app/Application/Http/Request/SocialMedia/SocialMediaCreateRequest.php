<?php

declare(strict_types=1);

namespace App\Application\Http\Request\SocialMedia;

use Hyperf\Validation\Request\FormRequest;

class SocialMediaCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'icon' => 'required',
            'url'  => 'required',
        ];
    }
}
