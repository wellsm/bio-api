<?php

declare(strict_types=1);

namespace App\Application\Http\Request\Category;

use Hyperf\Validation\Request\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function all(): array
    {
        return array_merge([
            'id' => $this->route('category'),
        ], $this->post());
    }

    public function rules(): array
    {
        return [
            'id'   => 'required|numeric',
            'name' => 'required',
        ];
    }
}
