<?php

namespace App\Services\Cars;

use App\Entities\AbstractEntity;
use App\Entities\CarListEntity;
use App\Models\Car;
use CP\Filter\Filter;

class CarListService
{
    public function getAll(array $filters = []): AbstractEntity
    {
        $cars = Car::query()->get()->toArray();
        $cp_filter = new Filter();
        foreach ($filters['like'] ?? [] as $fieldName => $fieldValue) {
            $ast = $cp_filter->getAst("like($fieldName, \"$fieldValue\")");
            $cars = $ast->apply($cars);
        }
        $cars_count = count($cars);

        return CarListEntity::fromArray([
            'data' => $cars,
            'total_count' => $cars_count,
        ]);
    }
}
