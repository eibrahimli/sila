<?php

use App\Http\Controllers\ProductController;

Route::prefix('product')->name('product.')->group(function () {

    Route::get('{product}-{slug}', [ProductController::class, 'show'])->name('show');
    Route::post('addtocart/{product}', [ProductController::class, 'addToCart'])->name('addToCart');
    //Ajax Routes
    Route::get('get/{product}', [ProductController::class, 'getProduct'])->name('getProduct');
  });