<?php

namespace App\Http\Resources;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Product $resource
 */
class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'product_id' => $this->resource->getKey(),
            'user_id' => $this->resource->getAuthorIdentifier(),
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'price' => $this->resource->price,
            'categories' => CategoryResource::collection($this->resource->categories),
            'created_at' => $this->resource->created_at ? Carbon::parse($this->resource->created_at)->toDateTimeString() : null,
            'updated_at' => $this->resource->updated_at ? Carbon::parse($this->resource->updated_at)->toDateTimeString() : null,
            'deleted_at' => $this->resource->deleted_at ? Carbon::parse($this->resource->deleted_at)->toDateTimeString() : null,
        ];
    }
}
