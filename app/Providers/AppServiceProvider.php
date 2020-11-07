<?php

namespace App\Providers;

use App\Models\Setting;
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

    view()->composer(['frontend.layouts.app','frontend.index','frontend.inc.header'], function ($view) {
      $setting = Setting::first();
      $view->with('setting', $setting);
    });
  }
}
