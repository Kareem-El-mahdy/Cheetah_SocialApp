<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, 'index']);
Route::get(uri: '/posts', action: [PostController::class, 'index']) ->name(name: 'posts.index');
Route::get(uri: '/posts/create', action: [PostController::class, 'create']) ->name(name: 'posts.create');
Route::get(uri: '/posts/{post}', action: [PostController::class, 'show']) ->name(name: 'posts.show');
Route::post(uri: '/posts/store', action: [PostController::class, 'store']) ->name(name: 'posts.store');
Route::put(uri: '/posts/{post}', action: [PostController::class, 'update']) ->name(name: 'posts.update');
Route::get(uri: '/posts/{post}/edit', action: [PostController::class, 'edit']) ->name(name: 'posts.edit');
Route::delete(uri: '/posts/{post}', action: [PostController::class, 'destroy']) ->name(name: 'posts.destroy');