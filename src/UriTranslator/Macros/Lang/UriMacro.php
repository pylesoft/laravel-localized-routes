<?php

namespace CodeZero\UriTranslator\Macros\Lang;

use CodeZero\UriTranslator\UriTranslator;
use Illuminate\Support\Facades\App;
use Illuminate\Translation\Translator;

class UriMacro
{
    /**
     * Register the macro.
     */
    public static function register(): void
    {
        Translator::macro('uri', function (string $uri, ?string $locale = null, ?string $namespace = null): string {
            return App::make(UriTranslator::class)->translate($uri, $locale, $namespace);
        });
    }
}
