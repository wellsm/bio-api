<?php

declare(strict_types=1);

namespace App\Application\Http\Request\Link;

use Hyperf\Validation\Request\FormRequest;

class LinkUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function all(): array
    {
        return array_merge([
            'id' => $this->route('link'),
        ], $this->post());
    }

    public function rules(): array
    {
        return [
            'id'        => 'required|numeric',
            'title'     => 'required',
            'url'       => 'required|url',
            'thumbnail' => 'nullable|image'
        ];
    }
}
