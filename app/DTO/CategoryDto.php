<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class CategoryDto extends DataTransferObject
{
    public int $userId;
    public string $name;
    public ?string $description;

    public static function fromRequest(Request $request): CategoryDto
    {
        return new self([
            'userId' => $request->user()?->getAuthIdentifier(),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);
    }
}
