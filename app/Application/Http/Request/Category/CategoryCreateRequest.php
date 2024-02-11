<?php

declare(strict_types=1);

namespace App\Application\Http\Request\Category;

use Hyperf\Validation\Request\FormRequest;

class CategoryCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
        ];
    }
}
