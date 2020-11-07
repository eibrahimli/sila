<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OnlySeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(@auth()->user()->role != 'seller' || !auth()->check()):
            return redirect()->route('seller.login');
        endif;
        return $next($request);
    }
}
