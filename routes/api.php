<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('atributes', AttributeController::class);
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);
Route::resource('features', FeatureController::class);

Route::prefix('menus')->group(function () {
    Route::get('categories', [CategoryController::class, 'menus_categories']);
});

Route::prefix('cards')->group(function () {
    Route::get('categories', [CategoryController::class, 'cards_categories']);
});

Route::get('categories/slide/cards', [CategoryController::class, 'cards']);
Route::get('attributes/marks/terms', [AttributeController::class, 'terms']);