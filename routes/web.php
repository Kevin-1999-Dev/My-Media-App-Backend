<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::get('dashboard', [ProfileController::class, 'index'])->name('admin#profile');
    Route::post('admin/profile/update', [ProfileController::class, 'change'])->name('admin#profileUpdate');
    Route::get('admin/profile/directChangePw', [ProfileController::class, 'directChangePassword'])->name('admin#directChangePassword');
    Route::post('admin/profile/changePassword', [ProfileController::class, 'changePassword'])->name('admin#changePassword');

    Route::get('admin/list', [ListController::class, 'index'])->name('admin#list');
    Route::get('admin/list/delete/{id}', [ListController::class, 'destroy'])->name('admin#listDelete');
    Route::post('admin/list', [ListController::class, 'searchList'])->name('admin#listSearch');

    Route::get('admin/category', [CategoryController::class, 'index'])->name('admin#category');
    Route::post('admin/category/create', [CategoryController::class, 'store'])->name('admin#categoryCreate');
    Route::post('admin/category', [CategoryController::class, 'searchCategory'])->name('admin#categorySearch');
    Route::get('admin/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin#categoryDelete');
    Route::get('admin/category/edit/{id}', [CategoryController::class, 'editPage'])->name('admin#categoryEditPage');
    Route::post('admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin#categoryEdit');


    Route::get('admin/post', [PostController::class, 'index'])->name('admin#post');
    Route::post('admin/post/create', [PostController::class, 'store'])->name('admin#postCreate');
    Route::get('admin/post/delete/{id}', [PostController::class, 'destroy'])->name('admin#postDelete');
    Route::get('admin/post/editPage/{id}', [PostController::class, 'editPage'])->name('admin#postEditPage');
    Route::post('admin/post/edit/{id}', [PostController::class, 'edit'])->name('admin#postEdit');

    Route::get('admin/trend', [ReactionController::class, 'index'])->name('admin#trend');


});
