<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminStockController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminBrandController;
use App\Http\Controllers\Admin\AdminBannerController;
use App\Http\Controllers\Admin\AdminColorController;
use App\Http\Controllers\UnitController;

    Route::name('admin.')->namespace('Admin')->prefix('admin')->group(function () {

        Route::middleware('guest')->group(function () {
        // Admin Login Routes
            Route::get('login', [AdminController::class, 'loginView'])->name('loginView');
            Route::post('login', [AdminController::class, 'loginStore'])->name('loginStore');
        // End of Admin Login Routes

        // Forgot password routes
            Route::view('forgot-password', 'backend.reset')->name('password.request');
            Route::post('forgot-password', [AdminController::class, 'forgotPassword'])->name('password.email');

            Route::post('reset-password', [AdminController::class, 'resetPassword'])->name('password.update');
        // End of Forgot Password
        });


        Route::middleware(['admin', 'verified'])->group(function () {
        Route::get('', [AdminController::class, 'index'])->name('index');
        Route::get('ayarlar', [SettingController::class, 'edit'])->name('edit');
        Route::get('settings', [SettingController::class, 'settings']);
        Route::post('settings', [SettingController::class, 'update'])->name('update');

        // Admin User Routes
            Route::name('user.')->prefix('user')->group(function () {
                Route::get('', [AdminUserController::class, 'index'])->name('index');
                Route::get('{user}/edit', [AdminUserController::class, 'edit'])->name('edit');
                Route::get('{user}', [AdminUserController::class, 'editVue']);
                Route::patch('{user}', [AdminUserController::class, 'update'])->name('update');
                Route::delete('{user}', [AdminUserController::class, 'destroy'])->name('destroy');
            });

        //End Admin User Routes

        // Categories routes

            Route::name('category.')->prefix('category')->group(function () {
                Route::get('', [AdminCategoryController::class, 'index'])->name('index');
                Route::get('categories', [AdminCategoryController::class, 'getCategories']);
                Route::get('create', [AdminCategoryController::class, 'create'])->name('create');
                Route::post('store', [AdminCategoryController::class, 'store'])->name('store');
                Route::get('{category}/edit', [AdminCategoryController::class, 'edit'])->name('edit');
                Route::get('{category}/getcategory', [AdminCategoryController::class, 'getCategory'])->name('getCategory');
                Route::get('subcategories/{category}', [AdminCategoryController::class, 'subcategories'])->name('subcategories');
                Route::patch('{category}', [AdminCategoryController::class, 'update'])->name('update');
                Route::delete('{category}', [AdminCategoryController::class, 'destroy'])->name('destroy');
            });

        // End Categories routes

        // Products routes
            Route::name('product.')->prefix('product')->group(function() {
                Route::get('active/all', [AdminProductController::class, 'activeIndex'])->name('activeIndex');
                Route::get('notactive/all', [AdminProductController::class, 'NotActiveIndex'])->name('NotActiveIndex');
                Route::get('{product}', [AdminProductController::class, 'activeProduct'])->name('activeProduct');
                Route::get('{product}/edit', [AdminProductController::class, 'edit'])->name('edit');
                Route::delete('{product}', [AdminProductController::class, 'destroy'])->name('destroy');

                // Product Ajax Routes
                  Route::get('{product}/single', [AdminProductController::class, 'getSingleProduct'])->name('getProductUrl');
                  Route::get('get/cats', [AdminProductController::class, 'getCat'])->name('getCat');
                  Route::post('{product}/photos', [AdminProductController::class, 'updatePhotos'])->name('updatePhotos');
                  Route::post('stock/{product}/photos', [AdminStockController::class, 'deletePhotos'])->name('deletePhotos');

                  Route::patch('add/{product}/color/', [AdminStockController::class, 'addColor'])->name('addColor');
                  Route::patch('{product}', [AdminProductController::class, 'update'])->name('update');
                  Route::patch('update/{product}/stock', [AdminStockController::class, 'updateColorStock'])->name('updateColorStock');
                  Route::patch('update/{product}/specs', [AdminProductController::class, 'updateSpecs'])->name('updateSpecs');

                  Route::post('delete/color/stock', [AdminStockController::class, 'deleteSingleColorStock'])->name('deleteSingleColorStock');

                // Product End Ajax Routes
            });

        // End Products Routes

        // Admin Store Routes
            
            Route::name('store.')->prefix('store')->group( function () {
                Route::get('{store}', [AdminStoreController::class, 'show'])->name('show');
            });

        // End Admin Store Routes

        // Admin Orders Routes
            Route::name('order.')->prefix('order')->group(function () {
              Route::get('active', [AdminOrderController::class, 'index'])->name('index');
              Route::get('notactive', [AdminOrderController::class, 'notActiveIndex'])->name('notActiveIndex');
              Route::get('not/active/orders', [AdminOrderController::class, 'getNotActiveOrders'])->name('getNotActiveOrders');
              Route::get('{order}', [AdminOrderController::class, 'show'])->name('show');

              Route::get('not/active/orders', [AdminOrderController::class, 'getNotActiveOrders'])->name('getNotActiveOrders');
              Route::get('active/orders', [AdminOrderController::class, 'getActiveOrders'])->name('getActiveOrders');
              Route::patch('active/{order}', [AdminOrderController::class, 'activeOrder'])->name('activeOrder');
              Route::delete('{order}', [AdminOrderController::class, 'destroy'])->name('destroy');
              Route::delete('activeorders/{order}', [AdminOrderController::class, 'activeDestroy'])->name('active_destroy');
            });
        // End Admin Orders Routes


        // Brand routes

        Route::name('brand.')->prefix('brand')->group(function () {
            Route::get('', [AdminBrandController::class, 'index'])->name('index');            
            Route::get('create', [AdminBrandController::class, 'create'])->name('create');
            Route::post('store', [AdminBrandController::class, 'store'])->name('store');
            Route::get('{brand}/edit', [AdminBrandController::class, 'edit'])->name('edit');                
            Route::patch('{brand}', [AdminBrandController::class, 'update'])->name('update');
            Route::delete('{brand}', [AdminBrandController::class, 'destroy'])->name('destroy');
        });

        // End Brand routes

        // All Page Routes
            
            Route::name('page.')->prefix('page')->group(function() {
                Route::get('{page}/edit', [AdminPageController::class, 'edit'])->name('edit');
                Route::patch('{page}', [AdminPageController::class, 'update'])->name('update');
            });
        
        // End of All Page Routes

        // Colors routes

            Route::name('color.')->prefix('color')->group(function () {
                Route::get('', [AdminColorController::class, 'index'])->name('index');            
                Route::get('create', [AdminColorController::class, 'create'])->name('create');
                Route::post('store', [AdminColorController::class, 'store'])->name('store');
                Route::get('{color}/edit', [AdminColorController::class, 'edit'])->name('edit');                
                Route::patch('{color}', [AdminColorController::class, 'update'])->name('update');
                Route::delete('{color}', [AdminColorController::class, 'destroy'])->name('destroy');
            });

        // End Colors routes

        // Units routes

            Route::name('unit.')->prefix('unit')->group(function () {
                Route::get('', [UnitController::class, 'index'])->name('index');            
                Route::get('create', [UnitController::class, 'create'])->name('create');
                Route::post('store', [UnitController::class, 'store'])->name('store');
                Route::get('{unit}/edit', [UnitController::class, 'edit'])->name('edit');                
                Route::patch('{unit}', [UnitController::class, 'update'])->name('update');
                Route::delete('{unit}', [UnitController::class, 'destroy'])->name('destroy');
            });

        // End Units routes


        // All Banners Routes

            Route::name('banner.')->prefix('banner')->group(function(){
                Route::get('', [AdminBannerController::class, 'index'])->name('index');

                Route::post('store', [AdminBannerController::class, 'store'])->name('store');

                Route::get('delete/{banner}', [AdminBannerController::class, 'destroy'])->name('destroy');
            });

        // End of All Banners Routes
        });

    });

?>