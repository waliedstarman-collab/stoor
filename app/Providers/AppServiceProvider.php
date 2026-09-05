<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   public function boot(): void
{
    // إجبار HTTPS في الإنتاج
    if (app()->environment('production')) {
        \Illuminate\Support\Facades\URL::forceScheme('https');
    }

    // تعريف Gate للسماح لأي مستخدم مسجل بالدخول إلى لوحة التحكم
    Gate::define('viewAdmin', function ($user) {
        return true;
    });
}
}