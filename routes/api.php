<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckAuthor;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function  () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('me', [AuthController::class, 'me'])->name('me');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });
});

Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
     Route::get('', [CategoryController::class, 'index'])->name('index');
     Route::group(['middleware' => 'auth:api'], function () {
         Route::get('my', [CategoryController::class, 'byAuthor'])->name('my');
         Route::post('', [CategoryController::class, 'store'])->name('store');
         Route::group(['prefix' => '{category}'], function () {
             Route::get('', [CategoryController::class, 'show'])->name('show');
             Route::get('products', [CategoryController::class, 'byProducts'])->name('show');
             Route::group(['middleware' => [CheckAuthor::class]], function () {
                 Route::put('', [CategoryController::class, 'update'])->name('update');
                 Route::delete('', [CategoryController::class, 'destroy'])->name('destroy');
             });
         });
     });
});

Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
    Route::get('', [ProductController::class, 'index'])->name('index');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('my', [ProductController::class, 'byAuthor'])->name('my');
        Route::post('', [ProductController::class, 'store'])->name('store');
        Route::group(['prefix' => '{product}'], function () {
            Route::get('', [ProductController::class, 'show'])->name('show');
            Route::group(['middleware' => [CheckAuthor::class]], function () {
                Route::put('', [ProductController::class, 'update'])->name('update');
                Route::delete('', [ProductController::class, 'destroy'])->name('destroy');
                Route::post('attach', [ProductController::class, 'attach'])->name('attach');
            });
        });
    });
});
