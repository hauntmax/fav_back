<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class ProductDto extends DataTransferObject
{
    public ?int $userId;
    public string $name;
    public string $description;
    public float $price;

    public static function fromRequest(Request $request): ProductDto
    {
        return new self([
            'userId' => $request->user()?->getAuthIdentifier(),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
        ]);
    }
}
