<?php

use App\Http\Controllers\ChocolateController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/chocolates',[ChocolateController::class,'index']);
Route::post('/chocolates',[ChocolateController::class,'store']);

Route::get('/orders',[OrderController::class,'index']);
Route::post('/orders',[OrderController::class,'store']);
Route::put('/orders/{id}',[OrderController::class,'update']);
Route::delete('/orders/{id}',[OrderController::class,'destroy']);