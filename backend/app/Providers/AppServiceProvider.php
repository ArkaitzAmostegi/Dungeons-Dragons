<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
    use Illuminate\Support\Facades\URL;

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
        if (!app()->runningInConsole()) {
            URL::forceRootUrl(request()->getSchemeAndHttpHost());

            // Si algún día se publica por https detrás del proxy:
            if (request()->header('X-Forwarded-Proto') === 'https') {
                URL::forceScheme('https');
            }
        }
    }

}
