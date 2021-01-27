<?php

use App\Http\Controllers\ProductController;

Route::prefix('product')->name('product.')->group(function () {

    Route::get('{product}-{slug}', [ProductController::class, 'show'])->name('show');
  });