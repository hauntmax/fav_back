<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'created_at' => $this->resource->created_at ? Carbon::parse($this->resource->created_at)->toDateTimeString() : null,
            'updated_at' => $this->resource->updated_at ? Carbon::parse($this->resource->updated_at)->toDateTimeString() : null,
        ];
    }
}
