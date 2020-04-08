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
    Route::get('/', 'ProductControllers\ProductFetchController@list');
    Route::get('/{productId}', 'ProductControllers\ProductFetchController@get');
    Route::post('/store/{productId?}', 'ProductControllers\ProductStoreController@store');
    Route::delete('/delete/{productId}', 'ProductControllers\ProductDeleteController@delete');
});

Route::fallback(function() {
    return response()->json([
		'message' 	=> 'Page not found.',
	], 404);
});