<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserHasToHaveStore
{
  /**
   * Handle an incoming request.
   *
   * @param \Illuminate\Http\Request $request
   * @param \Closure $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {
    if (auth()->user()->stores()->count() == 0):
      return redirect()->route('seller.index')
                       ->with('statusWarning', 'Mağazanızı qeyd etdikdən sonra məhsul əlavə edə biləcəksiniz!!');
    endif;

    return $next($request);
  }
}
