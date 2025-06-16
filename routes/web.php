<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\HomeController as UserHomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('weather', function () {
    Route::get('', [\App\Http\Controllers\WeatherController::class, 'get']);
});

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function  () {
    Route::get('login', [AuthController::class, 'loginPage'])->name('login.page');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::group(['middleware' => 'auth:web'], function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});

Route::group(['prefix' => '', 'as' => 'user.'], function () {
    Route::get('', [UserHomeController::class, 'home'])->name('home');
    Route::group(['prefix' => 'services', 'as' => 'services.'], function () {
        Route::get('', [\App\Http\Controllers\User\YandexServiceController::class, 'list'])->name('list');
        Route::get('yandex', [\App\Http\Controllers\User\YandexServiceController::class, 'show'])->name('yandex');
        Route::post('yandex', [\App\Http\Controllers\User\YandexServiceController::class, 'export'])->name('export');
    });
});
