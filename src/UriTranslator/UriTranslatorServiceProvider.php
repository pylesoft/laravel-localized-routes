<?php

namespace CodeZero\UriTranslator;

use CodeZero\UriTranslator\Macros\Lang\UriMacro;
use Illuminate\Support\ServiceProvider;

class UriTranslatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        UriMacro::register();
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // No additional services to register
    }
}
