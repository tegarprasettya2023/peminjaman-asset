<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);

// Route resource untuk products
Route::resource('/products', ProductController::class);

// Definisikan route user.index sebagai halaman index dari ProductController
Route::get('/users', [ProductController::class, 'index'])->name('user.index');

// update
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

