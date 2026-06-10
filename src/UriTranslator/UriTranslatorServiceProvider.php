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
        //
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        UriMacro::register();
    }
}
