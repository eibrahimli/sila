<?php

use App\Http\Controllers\Seller\SellerStockController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerStoreController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Admin routes

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

  });

});

// End of Admin Routes

// Admin routes

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
    Route::get('getcats', [SellerProductController::class, 'getCat'])->name('getCat');

    // Seller Product Routes
    Route::name('product.')->prefix('product')->group(function () {
      Route::get('', [SellerProductController::class, 'index'])->name('index');
      Route::get('create', [SellerProductController::class, 'create'])->name('create');
      Route::post('', [SellerProductController::class, 'store'])->name('store');
      Route::get('{product}/photos',[SellerProductController::class, 'getPhotos'])->name('getPhotos');
      Route::post('{product}/photos', [SellerProductController::class, 'updatePhotos'])->name('updatePhotos');
      Route::get('{product}/edit', [SellerProductController::class, 'edit'])->name('edit');
      Route::get('{product}/single', [SellerProductController::class, 'getSingleProduct'])->name('getProductUrl');
      Route::get('{product}/specs',[SellerProductController::class, 'getSpecs'])->name('getSpecs');
      Route::patch('{product}/update/spec', [SellerProductController::class, 'updateProductSpecs']);
      Route::patch('{product}/update/stock', [SellerProductController::class, 'updateProductStock']);
      Route::patch('{product}/update/first', [SellerProductController::class, 'updateProduct'])->name('updateProduct');
      Route::get('{product}', [SellerProductController::class, 'editVue']);
      Route::patch('{product}', [SellerProductController::class, 'update'])->name('update');
      Route::delete('{product}', [SellerProductController::class, 'destroy'])->name('destroy');
      Route::post('{product}/stock', [SellerProductController::class, 'deletePhotos'])->name('deletePhotos');

      // Product stock routes

      Route::get('get/{product}/colors', [SellerStockController::class, 'getColorsRelatedToProduct'])->name('getColorsRelatedToProduct');
      Route::patch('delete/{product}/color', [SellerStockController::class, 'deleteColorStock'])->name('deletColorStock');
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

// End of Admin Routes

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
Route::get('', [SiteController::class, 'index'])->name('index');


// My Account routes

Route::name('user.')->prefix('user')->group(function () {
  // Register and login routes
  Route::post('giris', [UserController::class, 'giris']);
  Route::post('qeydiyyat', [UserController::class, 'qeydiyyat']);
  // End of Register and login routes

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

