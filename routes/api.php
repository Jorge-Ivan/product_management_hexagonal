<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PriceListController;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('products', ProductController::class)->only('store', 'update', 'destroy');
    Route::resource('categories', CategoryController::class)->only('store', 'update', 'destroy');
    Route::get('price-list', [PriceListController::class, 'index'])->name('price-list');
});
