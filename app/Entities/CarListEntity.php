<?php

namespace App\Entities;

/**
 * @property $data
 * @property int $total_count
 */
class CarListEntity extends AbstractEntity
{
    public function fields(): array
    {
        return [
            'data', 'total_count',
        ];
    }
}
