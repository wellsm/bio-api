<?php

declare(strict_types=1);

namespace App\Application\Http\Request\Collection;

use Hyperf\Validation\Request\FormRequest;

class CollectionCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required',
            'description' => 'nullable',
            'links'       => 'required|array',
        ];
    }
}
