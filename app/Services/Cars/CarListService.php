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
        $cars = Car::query()->get();

        foreach ($filters['like'] ?? [] as $fieldName => $fieldValue) {
            $cp_filter = new Filter();
            $ast = $cp_filter->getAst("like($fieldName, \"$fieldValue\")");
            $cars = $cars->filter(function ($car) use ($ast, $fieldName, $fieldValue) {
                return $ast->apply([$fieldName => $car->$fieldName]);
            });
        }

        return CarListEntity::fromArray([
            'data' => $cars,
            'total_count' => $cars->count(),
        ]);
    }
}
