<?php

declare(strict_types=1);

namespace App\Application\Http\Request\Link;

use Hyperf\Validation\Request\FormRequest;

class LinkCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'     => 'required',
            'url'       => 'required|url',
            'thumbnail' => 'required|image'
        ];
    }
}
