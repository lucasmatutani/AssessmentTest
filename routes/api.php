<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Books\BookController;
use App\Http\Controllers\Stores\StoreController;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('books', BookController::class);
    Route::apiResource('stores', StoreController::class);
});