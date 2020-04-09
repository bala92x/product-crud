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
    Route::get('/', 'ProductController@index');
    Route::get('/{productId}', 'ProductController@show');
    Route::post('/', 'ProductController@store');
    Route::post('/{productId?}', 'ProductController@update');
    Route::delete('/{productId}', 'ProductController@destroy');
});

Route::fallback(function() {
    return response()->json([
		'message' 	=> 'Page not found.',
	], 404);
});