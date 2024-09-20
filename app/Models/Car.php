<?php

namespace App\Models;

use App\Models\AbstractModels\AbstractBaseModel;
use App\Models\AbstractModels\SlaveableModel;

/**
 * @property int $Id
 * @property string $VIN
 * @property string $RegNumber
 * @property string $Model
 * @property string $Brand
 */
class Car extends AbstractBaseModel
{
    use SlaveableModel;

    protected $table = 'Car';
    protected $guarded = [];
}
