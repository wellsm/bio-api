<?php

declare(strict_types=1);

namespace App\Application\Http\Request\Category;

use Hyperf\Validation\Request\FormRequest;

class CategoryDeleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function all(): array
    {
        return [
            'id' => $this->route('category'),
        ];
    }

    public function rules(): array
    {
        return [
            'id' => 'required|numeric',
        ];
    }
}
