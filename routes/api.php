<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Books\BookController;
use App\Http\Controllers\Stores\StoreController;
use App\Http\Controllers\Auth\AuthController;



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('books', BookController::class);
    Route::apiResource('stores', StoreController::class);

    //Routes for Store
    Route::post('/stores/{storeId}/books', [StoreController::class, 'attachBooks']);
    Route::delete('/stores/{storeId}/books', [StoreController::class, 'detachBooks']);
    Route::get('/stores/{storeId}/books', [StoreController::class, 'getBooks']);

    // Routes for Book
    Route::post('/books/{bookId}/stores', [BookController::class, 'attachStores']);
    Route::delete('/books/{bookId}/stores', [BookController::class, 'detachStores']);
    Route::get('/books/{bookId}/stores', [BookController::class, 'getStores']);
});