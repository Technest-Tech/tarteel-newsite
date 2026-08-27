<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // The project ships no CSS framework, so the paginator uses our own view.
        Paginator::defaultView('pagination.tarteel');
        Paginator::defaultSimpleView('pagination.tarteel');

        // Shared hosting terminates TLS in front of PHP; honour the configured
        // scheme so canonical URLs and asset links are not downgraded to http.
        if (str_starts_with((string) config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }
    }
}
