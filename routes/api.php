<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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
Route::get('/products', [ProductController::class,'index']);
Route::get('/products/{id}', [ProductController::class,'show']);



Route::post('/login', [AuthController::class,'login']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::delete('/products/{id}', [ProductController::class,'destroy']);

    Route::post('/products', [ProductController::class,'store']);
    Route::put('/products/{id}', [ProductController::class,'update']);
    

    Route::post('/logout', [AuthController::class,'logout']);
});




