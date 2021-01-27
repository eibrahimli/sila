<?php

// Alla Frontend Category routes will come here

use App\Http\Controllers\CategoryController;

Route::prefix('category')->name('category.')->group(function () {
  Route::get('{category}-{slug}', [CategoryController::class, 'show'])->name('show');

  //Ajax Routes
  Route::get('get/{category}', [CategoryController::class, 'getCategory'])->name('getCategory');
  Route::get('get/{category}/sr', [CategoryController::class, 'sortingCategoryProduct'])->name('sortingCategoryProduct');
});