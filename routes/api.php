<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminOrderController;

Route::get('orders', [AdminOrderController::class, 'index'])->name('api.orders.index');
Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('api.orders.show');
Route::put('orders/{order}', [AdminOrderController::class, 'update'])->name('api.orders.update');
