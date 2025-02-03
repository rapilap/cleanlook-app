<?php

use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoryCourierController;

Route::get('/transactions', [HistoryCourierController::class, 'index']);
Route::post('/transactions', [HistoryCourierController::class, 'store']);
Route::delete('/transactions/{id}', [HistoryCourierController::class, 'destroy']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/midtrans-callback', [OrderController::class, 'callback']);