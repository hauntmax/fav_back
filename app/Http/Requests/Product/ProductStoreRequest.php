<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string',],
            'price' => ['nullable', 'decimal:0,2'],
            'category_ids' => ['nullable', 'array', 'exists:categories,category_id'],
        ];
    }
}
