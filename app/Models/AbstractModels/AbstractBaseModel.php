<?php

namespace App\Models\AbstractModels;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractBaseModel extends Model
{
    public const MASTER_MYSQL_1 = 'master_mysql_1';

    public const SLAVE_MYSQL_1 = 'slave_mysql_1';

    public static array $connection_names = [
        self::MASTER_MYSQL_1 => 'master_mysql_1',
        self::SLAVE_MYSQL_1 => 'slave_mysql_1',
    ];

    /**
     * @var null|string
     */
    protected $connection = null;
}
