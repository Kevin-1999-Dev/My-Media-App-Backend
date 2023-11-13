<?php

use App\Http\Controllers\Api\ActionLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('register',[AuthController::class,'register']);
Route::post('login', [AuthController::class, 'login']);

Route::post('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
Route::get('allpost', [PostController::class, 'show']);
Route::post('searchPost', [PostController::class, 'search']);
Route::get('allcategory', [CategoryController::class, 'show']);
Route::post('searchCategory', [CategoryController::class, 'search']);
Route::post('post/detail', [PostController::class, 'detail']);
Route::post('post/actionLog', [ActionLogController::class, 'index']);
