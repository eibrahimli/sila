<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// Admin routes

Route::name('admin.')->namespace('Admin')->prefix('admin')->middleware('admin')->group(function() {
    Route::get('', [AdminController::class, 'index'])->name('index');
    Route::get('ayarlar', [SettingController::class,'edit'])->name('edit');
    Route::get('settings', [SettingController::class, 'settings']);
    Route::post('settings', [SettingController::class,'update'])->name('update');
});

// End of Admin Routes 

// Admin Login Routes

Route::get('admin/login', [AdminController::class,'loginView'])->name('admin.loginView')->middleware('guest');
Route::post('admin/login', [AdminController::class,'loginStore'])->name('admin.loginStore')->middleware('guest');
Route::post('logout',[SiteController::class,'logout'])->name('logout')->middleware('auth');

// End of Admin Login Routes

// Forgot password routes

Route::view('/forgot-password', 'backend.reset')->middleware(['guest'])->name('password.request');
Route::post('/forgot-password', [AdminController::class, 'forgotPassword'])->middleware(['guest'])->name('password.email');
Route::get('/reset-password/{token}', function ($token) {
    return view('backend.reset-password', ['token' => $token]);
})->middleware(['guest'])->name('password.reset');
Route::post('/reset-password', [AdminController::class, 'resetPassword'])->middleware(['guest'])->name('password.update');

// End of Forgot Password

// Site routes
Route::get('',[SiteController::class,'index'])->name('index');
