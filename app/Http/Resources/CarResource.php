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
            'Id' => Arr::get($this->resource, 'Id'),
            'RegNumber' => Arr::get($this->resource, 'RegNumber'),
            'VIN' => Arr::get($this->resource, 'VIN'),
            'Model' => Arr::get($this->resource, 'Model'),
            'Brand' => Arr::get($this->resource, 'Brand'),
        ];
    }
}
