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

Route::get('/', function() {
    return response()->json([
		'version' => config('app.version')
	]);
})->name('version');

Route::apiResource('products', 'ProductController')->parameters(['products' => 'productId']);

Route::apiResource('images', 'ImageController')->parameters(['images' => 'imageId']);
Route::post('images/upload', 'ImageController@upload')->name('images.upload');

Route::fallback(function() {
    return response()->json([
		'message' 	=> 'Page not found.',
	], 404);
})->name('404');