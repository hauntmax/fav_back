<?php

namespace App\Http\Resources;

use App\Models\Car;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class CarResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'Id' => $this->resource->getKey(),
            'RegNumber' => $this->resource->RegNumber,
            'Vin' => $this->resource->VIN,
            'Model' => $this->resource->Model,
            'Brand' => $this->resource->Brand,
        ];
    }
}
