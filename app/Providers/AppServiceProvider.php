<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(function($query) {
            Log::info('DB_LISTEN', [
                'query' => $query->sql,
                'bindings' => $query->bindings,
                'connection' => [
                    'dbname' => $query->connection->getDatabaseName(),
                ]
            ]);
        });
    }
}
