<?php

declare(strict_types=1);

namespace App\Application\Http\Request\SocialMedia;

use Hyperf\Validation\Request\FormRequest;

class SocialMediaUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function all(): array
    {
        return array_merge([
            'id' => $this->route('media'),
        ], $this->post());
    }

    public function rules(): array
    {
        return [
            'id'         => 'required|numeric',
            'url'        => 'required',
            'icon'       => 'required',
            'active'     => 'required|boolean',
            'text_color' => 'required',
            'background' => 'required',
        ];
    }
}
