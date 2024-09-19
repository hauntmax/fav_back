<?php

namespace App\Http\Resources;

use App\Entities\CarListEntity;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property CarListEntity $resource
 */
class CarResourceCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'data' => CarResource::collection($this->resource->data),
            'meta' => [
                'total_count' => $this->resource->total_count,
            ]
        ];
    }
}
