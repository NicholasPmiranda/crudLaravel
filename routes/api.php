<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
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

Route::group(['prefix' => 'v1'], function () {

    Route::group(['prefix' => 'store'], function () {
        Route::get('', [StoreController::class, 'index']);
        Route::get('show/{store}', [StoreController::class, 'show']);
        Route::post('store', [StoreController::class, 'store']);
        Route::put('update/{store}', [StoreController::class, 'update']);
        Route::delete('delete/{store}', [StoreController::class, 'delete']);
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('', [ProductController::class, 'index']);
        Route::get('show/{product}', [ProductController::class, 'show']);
        Route::post('store', [ProductController::class, 'store']);
        Route::put('update/{product}', [ProductController::class, 'update']);
        Route::delete('delete/{product}', [ProductController::class, 'delete']);
    });

});



