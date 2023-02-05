<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class AttachCategoriesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category_ids' => ['required', 'array', 'exists:categories,category_id'],
        ];
    }
}
