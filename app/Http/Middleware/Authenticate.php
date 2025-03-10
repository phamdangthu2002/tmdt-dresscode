<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::guard()->check()) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Bạn cần đăng nhập để truy cập trang này');
    }

}
