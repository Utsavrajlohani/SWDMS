<?php

namespace App\Providers;

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
        // Register Observers for Data Integrity


        // Global White-labeling configuration (Mocking DB settings for SaaS)
        \Illuminate\Support\Facades\View::share('appTheme', [
            'name' => env('APP_NAME', 'SWDMS Enterprise'),
            'primary_color' => 'indigo-600',
            'secondary_color' => 'emerald-500',
            'support_email' => 'support@swdms.in'
        ]);
    }
}
