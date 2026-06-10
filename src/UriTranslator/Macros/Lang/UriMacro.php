<?php

namespace CodeZero\UriTranslator\Macros\Lang;

use CodeZero\UriTranslator\UriTranslator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

class UriMacro
{
    /**
     * Register the macro.
     */
    public static function register(): void
    {
        Lang::macro('uri', function (string $uri, ?string $locale = null, ?string $namespace = null): string {
            return App::make(UriTranslator::class)->translate($uri, $locale, $namespace);
        });
    }
}
