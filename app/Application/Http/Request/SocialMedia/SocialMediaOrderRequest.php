<?php

declare(strict_types=1);

namespace App\Application\Http\Request\SocialMedia;

use Hyperf\Validation\Request\FormRequest;

class SocialMediaOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            '*.id'    => 'required|numeric',
            '*.order' => 'required|numeric'
        ];
    }
}
