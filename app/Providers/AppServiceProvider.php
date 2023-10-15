<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('components.navbar', function ($view) {
            if (Auth::check()) {
                $unreadNotificationCount = Auth::user()->unreadNotifications->count();
                $view->with('unreadNotificationCount', $unreadNotificationCount);
            }
        });
    }
}
