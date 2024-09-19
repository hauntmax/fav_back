<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $Id
 * @property string $VIN
 * @property string $RegNumber
 * @property string $Model
 * @property string $Brand
 */
class Car extends Model
{
    protected $table = 'Car';
    protected $guarded = [];
}
