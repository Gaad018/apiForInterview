<?php

use Illuminate\Http\Request;
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

//products
Route::apiResource('/products', App\Http\Controllers\ProductController::class);
Route::get('/products/{limit}/{offset}', [App\Http\Controllers\ProductController::class, 'index'])
    ->where(['limit' => '[0-9]+', 'offset' => '[0-9]+']);

Route::get('/products/{nameSupplier}/{sortingType}', [App\Http\Controllers\ProductController::class, 'sort'])
    ->where('sortingType', 'asc|desc');


//suppliers
Route::apiResource('/suppliers', App\Http\Controllers\SupplierController::class);
Route::get('/suppliers/{limit}/{offset}', [App\Http\Controllers\ProductController::class, 'index'])
    ->where(['limit' => '[0-9]+', 'offset' => '[0-9]+']);

