<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAccessMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // السماح لأي مستخدم مسجل دخول (للتجربة)
        if (auth()->check()) {
            return $next($request);
        }
        abort(403, 'غير مصرح لك بالدخول إلى لوحة التحكم.');
    }
}