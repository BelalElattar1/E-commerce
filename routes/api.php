<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JwtMiddleware;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware([JwtMiddleware::class])->group(function () {

    // Auth Controller
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Cart Controller
    Route::post('carts/add', [CartController::class, 'add']);
    Route::get('carts/show', [CartController::class, 'show']);
    Route::delete('carts/remove/{product}', [CartController::class, 'remove']);

    // Order Controller
    Route::post('orders/create', [OrderController::class, 'create']);
    Route::get('orders/getUserOrders', [OrderController::class, 'getUserOrders']);

});

// Order Controller
Route::get('orders/getVendorOrders/{vendor}', [OrderController::class, 'getVendorOrders']);
