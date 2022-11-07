<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ColorController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Models\Category;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
// for product
Route::group(['prefix' => 'products'], function() {
    Route::get('/', [ProductController::class,'index']);
    Route::post('store', [ProductController::class,'store']);
    Route::post('update/{id}', [ProductController::class,'update']);
    Route::get('edit/{id}', [ProductController::class,'edit']);
    Route::delete('delete/{id}', [ProductController::class,'delete']);
    Route::get('singleProduct/{id}', [ProductController::class,'singleProduct']);
});
// for category
Route::group(['prefix' => 'category'], function() {
    Route::get('/category', [CategoryController::class,'index']);
    Route::post('/store', [CategoryController::class,'store']);
});
// for color
Route::group(['prefix' => 'color'], function() {
    Route::get('/color', [ColorController::class,'index']);
    Route::post('/store', [ColorController::class,'store']);
});