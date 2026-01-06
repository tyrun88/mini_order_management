<?php

use App\Http\Controllers\Api\OrderController;

Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);
Route::patch('/orders/{id}', [OrderController::class, 'update']);
