<?php

namespace App\Models\AbstractModels;

use Exception;
use Illuminate\Database\ConnectionResolver;
use Illuminate\Support\Facades\DB;

trait SlaveableModel
{
    public static function boot()
    {
        parent::boot();
        try {
            DB::connection(self::MASTER_MYSQL_1)->query()->count();
        } catch (Exception $exception) {
            $connectionName = self::$connection_names[self::SLAVE_MYSQL_1];
            $connection = app('db')->connection($connectionName);
            $resolver = new ConnectionResolver;
            $resolver->addConnection($connectionName, $connection);
            $resolver->setDefaultConnection($connectionName);
            self::setConnectionResolver($resolver);
        }
    }
}
