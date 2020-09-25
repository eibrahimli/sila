<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->namespace('Admin')->prefix('admin')->middleware('admin')->group(function() {
    Route::get('', [AdminController::class, 'index'])->name('index');
    
});

Route::get('admin/login', [AdminController::class,'loginView'])->name('admin.loginView')->middleware('guest');
Route::post('admin/login', [AdminController::class,'loginStore'])->name('admin.loginStore')->middleware('guest');

Route::get('',[SiteController::class,'index'])->name('index');