<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Admin routes

  require_once 'admin_routes.php';

// End of Admin Routes

// Seller routes

  require_once 'seller_routes.php';

// End of Seller Routes

// Reset pass and logout routes
Route::get('reset-password/{token}', function ($token, Request $request) {
  $request->validate([
    'email' => 'required|email'
  ]);

  $user = \Illuminate\Support\Facades\DB::table('users')->where('email', $request->email)->first();
  if ($user->role == 'admin'):
    return view('backend.reset-password', compact('token'));
  else:
    return view('frontend.user.password.reset', compact('token'))->with('email', $request->email);
  endif;
})->name('password.reset')->middleware('guest');
Route::post('logout', [SiteController::class, 'logout'])->name('logout')->middleware('auth');
// End of Reset pass and logout routes

// Site routes
Route::get('', [IndexController::class, 'index'])->name('index');

// Ajax Routes

Route::get('get/all/colors', [SiteController::class, 'getAllColors'])->name('getAllColors');
Route::get('get/all/brands', [SiteController::class, 'getAllBrands'])->name('getAllBrands');

// Search routes

Route::post('search', [SearchController::class, 'entry'])->name('search');

  // All Fontend Category routes

    include_once 'frontend/category_routes.php';

  // End Of All frontend Category Routes

  // All Fontend product routes

    include_once 'frontend/product_routes.php';

  // End Of All frontend product Routes

  // All Frontend Cart Routes

  include_once 'frontend/cart_routes.php';

  // End of All Frontend Cart Routes


// My Account routes

Route::name('user.')->prefix('user')->group(function () {
  // Register and login routes
  Route::post('giris', [UserController::class, 'giris'])->name('giris');
  Route::post('qeydiyyat', [UserController::class, 'qeydiyyat']);
  // End of Register and login routes


  Route::get('single/{user}', [UserController::class, 'singleUser'])->middleware(['auth'])->name('singleUser');

  Route::middleware('auth')->group(function () {
      Route::get('dashboard/{user}', [UserController::class, 'dashboard'])->name('dashboard');
      Route::get('orders/{user}', [UserController::class, 'orders'])->name('orders');
      Route::get('orders/{user}/show/{order}', [UserController::class, 'orderShow'])->name('orderShow');
  });

  Route::get('loginregister', [UserController::class, 'loginregister'])->name('loginregister')->middleware('guest');
  Route::view('forgot-password', 'frontend.user.password.email')->middleware(['guest'])->name('password.request');
  Route::post('forgot-password', [UserController::class, 'sendResetMail'])->middleware(['guest']);
  Route::post('reset-password', [UserController::class, 'resetPassword'])->middleware(['guest']);
});

// End My Account routes


Route::get('email/verify', function () {
  if (auth()->user()->email_verified_at == null)
    return view('seller.notverified')->with('mes', 'Emailinizi təsdiq etməlisiniz');
  else return redirect()->route('index');
})->middleware(['auth'])->name('verification.notice');
Route::get('verified', function () {
  return view('verified')->with('status', session('status'));
})->name('verified');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
  $request->fulfill();
  return redirect()->route('verified')->with('status', 'Emailiniz təsdiqləndi');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
  if (auth()->user()->email_verified_at == null) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('statusOk', __('A fresh verification link has been sent to your email address.'));
  } else {
    return back()->with('status', 'Emailiniz artıq təsdiqlənib');
  }

})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('test/user', function(Request $request) {
  return view('frontend.user.orders');
});

// Login ord Register with Google

Route::get('/auth/google/redirect', [SocialController::class, 'googleRedirect'])->name('auth.google.redirect');

Route::get('/auth/google/callback', [SocialController::class, 'googleCallback'])->name('auth.google.callback');

// Login ord Register with Facebook

Route::get('/auth/facebook/redirect', [SocialController::class, 'facebookRedirect'])->name('auth.facebook.redirect');

Route::get('/auth/facebook/callback', [SocialController::class, 'facebookCallback'])->name('auth.facebook.callback');
