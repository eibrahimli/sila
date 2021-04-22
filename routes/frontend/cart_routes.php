<?php

use App\Http\Controllers\CartController;

Route::prefix('cart')->name('cart.')->group(function () {

    Route::get('', [CartController::class, 'index'])->name('index');
    Route::get('checkout',[CartController::class, 'checkout'])->name('checkout');

    // Ajax Cart Requests
    Route::get('all', [CartController::class, 'getCart'])->name('getCart');
    Route::patch('update/{rowId}', [CartController::class, 'update'])->name('update');
    Route::delete('{rowId}', [CartController::class, 'delete']);

    //Ajax Checkout Requests
    Route::post('payment', [CartController::class, 'store'])->name('store');

  });