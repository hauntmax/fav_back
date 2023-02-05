<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class IndexRequestDto extends DataTransferObject
{
    public ?int $page;
    public ?int $perPage;
    public ?array $filters;

    public ?int $userId;

    public static function fromRequest(Request $request)
    {
        return new self([
            'page' => $request->get('page'),
            'perPage' => $request->get('per-page'),
            'filters' => $request->get('filters'),
            'userId' => $request->user()?->getAuthIdentifier(),
        ]);
    }
}
