<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Setting;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Schema::defaultStringLength('191');

    view()->composer(['frontend.layouts.app','frontend.index','frontend.inc.header','frontend.inc.footer'], function ($view) {
      $setting = Setting::first();
      $categories = Category::all()->where('category_id', 0);
      $view->with('setting', $setting)->with('categories', $categories);
    });

    view()->composer(['frontend.inc.indexheader','frontend.inc.header'], function($view) {
      $cart = Cart::content();
      $total = 0;
      if($cart):

        foreach ($cart as $item) {
          $total += (float) $item->subtotal;
        }
      else:
        $cart = [];
      endif;

      $view->with('cart', $cart)->with('total', $total);
    });

    view()->composer(['frontend.inc.brands_carousel'], function($view) {
      $brands = Brand::all();

      $view->with('brands', $brands);
    });
  }
}
