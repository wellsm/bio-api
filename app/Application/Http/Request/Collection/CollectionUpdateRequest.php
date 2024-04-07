<?php

declare(strict_types=1);

namespace App\Application\Http\Request\Collection;

use Hyperf\Validation\Request\FormRequest;

class CollectionUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function all(): array
    {
        return array_merge([
            'id' => $this->route('collection'),
        ], $this->post());
    }

    public function rules(): array
    {
        return [
            'id'          => 'required|numeric',
            'name'        => 'required',
            'description' => 'nullable',
            'links'       => 'required|array',
        ];
    }
}
