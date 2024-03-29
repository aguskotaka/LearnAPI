<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/me', [AuthenticationController::class, 'me']);
    Route::post('/posts',[PostController::class, 'store']);
    Route::patch('/posts/{id}',[PostController::class, 'update'])->middleware('PostOwner');
    Route::delete('/posts/{id}',[PostController::class, 'destroy'])->middleware('PostOwner');

    Route::post('/comment', [CommentController::class, 'store']);
    Route::patch('/comment/{id}', [CommentController::class, 'update'])->middleware('CommentOwner');
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->middleware('CommentOwner');
});
