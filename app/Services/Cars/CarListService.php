<?php

namespace App\Services\Cars;

use App\Entities\AbstractEntity;
use App\Entities\CarListEntity;
use App\Models\Car;

class CarListService
{
    public function getAll(): AbstractEntity
    {
        return CarListEntity::fromArray([
            'data' => Car::query()->get(),
            'total_count' => Car::query()->count(),
        ]);
    }
}
