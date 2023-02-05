<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string',],
            'price' => ['nullable', 'numeric'],
            'category_ids' => ['nullable', 'array', 'exists:categories,category_id'],
        ];
    }
}
