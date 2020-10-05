<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->namespace('Admin')->prefix('admin')->middleware('admin')->group(function() {
    Route::get('', [AdminController::class, 'index'])->name('index');
    Route::get('ayarlar', [AdminController::class,'edit'])->name('edit');
    Route::post('ayarlar', [AdminController::class,'update'])->name('update');
});

Route::get('admin/login', [AdminController::class,'loginView'])->name('admin.loginView')->middleware('guest');
Route::post('admin/login', [AdminController::class,'loginStore'])->name('admin.loginStore')->middleware('guest');
Route::get('/forgot-password', function () {
    return view('backend.reset');
})->middleware(['guest'])->name('password.request');
Route::get('reset-password', function () {
    return 'ok';
})->middleware(['guest'])->name('password.reset');
Route::post('/forgot-password', [SiteController::class,'sendResetEmailLink'])->middleware(['guest'])->name('password.email');

Route::post('logout',[SiteController::class,'logout'])->name('logout')->middleware('auth');

Route::get('',[SiteController::class,'index'])->name('index');
