<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\SellerStockController;
use App\Http\Controllers\Seller\SellerStoreController;
use App\Http\Controllers\Seller\SellerProductController;

    Route::name('seller.')->namespace('Seller')->prefix('seller')->group(function () {

    Route::middleware(['guest'])->group(function () {
  
      Route::get('login', [SellerController::class, 'login'])->name('login');
      Route::post('login', [SellerController::class, 'loginStore'])->name('loginStore');
      Route::get('register', [SellerController::class, 'register'])->name('register');
      Route::post('register', [SellerController::class, 'store'])->name('store');
    });
  
    Route::middleware(['seller', 'verified'])->group(function () {
      Route::get('brand/all', [SellerController::class, 'allBrands'])->name('brand.all');
      Route::get('colors/all', [SellerController::class, 'allColors'])->name('colors.all');
      Route::get('', [SellerController::class, 'index'])->name('index');
      Route::get('{seller}/edit', [SellerController::class, 'edit'])->name('edit');
      Route::get('{seller}/user', [SellerController::class, 'getUser'])->name('getUser');
      Route::patch('{seller}', [SellerController::class, 'update'])->name('update');
  
      Route::get('getcats', [SellerProductController::class, 'getCat'])->name('getCat');
      // Seller Product Routes
      Route::name('product.')->middleware('SellerHasToHaveStore')->prefix('product')->group(function () {
        Route::get('', [SellerProductController::class, 'index'])->name('index');
        Route::get('notactive', [SellerProductController::class, 'notActiveIndex'])->name('notActiveIndex');
        Route::get('create', [SellerProductController::class, 'create'])->name('create');
        Route::post('', [SellerProductController::class, 'store'])->name('store');
        Route::get('{product}/photos',[SellerProductController::class, 'getPhotos'])->name('getPhotos');
        Route::post('{product}/photos', [SellerProductController::class, 'updatePhotos'])->name('updatePhotos');
        Route::get('{product}/edit', [SellerProductController::class, 'edit'])->name('edit');
        Route::get('{product}/single', [SellerProductController::class, 'getSingleProduct'])->name('getProductUrl');
        Route::get('{product}/specs',[SellerProductController::class, 'getSpecs'])->name('getSpecs');
        Route::patch('{product}/update/spec', [SellerProductController::class, 'updateProductSpecs'])->name('updateProductSpecs');
        Route::patch('{product}/update/stock', [SellerProductController::class, 'updateProductStock']);
        Route::patch('{product}/update/first', [SellerProductController::class, 'updateProduct'])->name('updateProduct');
        Route::get('{product}', [SellerProductController::class, 'editVue']);
        Route::patch('{product}', [SellerProductController::class, 'update'])->name('update');
        Route::delete('{product}', [SellerProductController::class, 'destroy'])->name('destroy');
        Route::post('{product}/stock', [SellerProductController::class, 'deletePhotos'])->name('deletePhotos');
  
        // Product stock routes
  
        Route::get('get/{product}/colors', [SellerStockController::class, 'getColorsRelatedToProduct'])->name('getColorsRelatedToProduct');
        Route::patch('delete/{product}/colors', [SellerStockController::class, 'deleteColorStock'])->name('deletColorStock');
        Route::post('delete/{product}/color', [SellerStockController::class, 'deleteSingleColorStock'])->name('deleteSingleColorStock');
      });
  
      // End Seller Product Routes
  
      // Seller Store Routes
  
      Route::name('store.')->prefix('store')->group(function () {
        Route::get('', [SellerStoreController::class, 'index'])->name('index');
        Route::get('create', [SellerStoreController::class, 'create'])->name('create');
        Route::get('{store}/edit', [SellerStoreController::class, 'edit'])->name('edit');
        Route::get('{store}/get', [SellerStoreController::class, 'getStore'])->name('getStore');
        Route::post('store', [SellerStoreController::class, 'store'])->name('store');
        Route::patch('{store}', [SellerStoreController::class, 'update'])->name('update');
        Route::delete('{store}', [SellerStoreController::class, 'destroy'])->name('destroy');
      });
  
      //End Seller Store Routes
  
    });
  
  });