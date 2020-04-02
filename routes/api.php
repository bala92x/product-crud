<?php

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

Route::prefix('products')->group(function () {
    Route::get('/', 'Product\ProductFetchController@list');
    Route::get('/{productId}', 'Product\ProductFetchController@get');
    Route::post('/store/{productId?}', 'Product\ProductStoreController@store');
    Route::delete('/delete/{productId}', 'Product\ProductDeleteController@delete');
});