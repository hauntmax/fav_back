<?php

namespace App\Http\Resources;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Category resource
 */
class CategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'category_id' => $this->resource->category_id,
            'user_id' => $this->resource->user_id,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'created_at' => $this->resource->created_at ? Carbon::parse($this->resource->created_at)->toDateTimeString() : null,
            'updated_at' => $this->resource->updated_at ? Carbon::parse($this->resource->updated_at)->toDateTimeString() : null,
            'deleted_at' => $this->resource->deleted_at? Carbon::parse($this->resource->deleted_at)->toDateTimeString() : null,
        ];
    }
}
