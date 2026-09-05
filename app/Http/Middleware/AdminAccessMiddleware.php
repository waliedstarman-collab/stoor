<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAccessMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // السماح فقط للمستخدم الذي بريده admin@example.com
        if (auth()->check() && auth()->user()->email === 'admin@example.com') {
            return $next($request);
        }

        abort(403, 'غير مصرح لك بالدخول إلى لوحة التحكم.');
    }
}