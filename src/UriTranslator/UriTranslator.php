<?php

namespace CodeZero\UriTranslator;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class UriTranslator
{
    /**
     * Translate a URI.
     *
     * @param string $uri The URI to translate
     * @param string|null $locale The locale to translate to
     * @param string|null $namespace The namespace for translations
     * 
     * @return string The translated URI
     */
    public function translate(string $uri, ?string $locale = null, ?string $namespace = null): string
    {
        $fullUriKey = $this->buildTranslationKey($uri, $namespace);

        // Attempt to translate the full URI.
        if (Lang::has($fullUriKey, $locale)) {
            return Lang::get($fullUriKey, [], $locale);
        }

        $segments = $this->splitUriIntoSegments($uri);

        // Attempt to translate each segment individually. If there is no translation
        // for a specific segment, then its original value will be used.
        $translations = $segments->map(function (string $segment) use ($locale, $namespace): string {
            $segmentKey = $this->buildTranslationKey($segment, $namespace);

            // If the segment is not a placeholder and the segment
            // has a translation, then update the segment.
            if (!Str::startsWith($segment, '{') && Lang::has($segmentKey, $locale)) {
                $segment = Lang::get($segmentKey, [], $locale);
            }

            return $segment;
        });

        // Rebuild the URI from the translated segments.
        return $translations->implode('/');
    }

    /**
     * Split the URI into a Collection of segments.
     *
     * @param string $uri The URI to split
     * 
     * @return \Illuminate\Support\Collection<int, string> Collection of URI segments
     */
    protected function splitUriIntoSegments(string $uri): Collection
    {
        $uri = trim($uri, '/');
        $segments = explode('/', $uri);

        return Collection::make($segments);
    }

    /**
     * Build a translation key, including the namespace and file name.
     *
     * @param string $key The translation key
     * @param string|null $namespace The namespace for translations
     * 
     * @return string The complete translation key
     */
    protected function buildTranslationKey(string $key, ?string $namespace = null): string
    {
        $namespace = $namespace ? "{$namespace}::" : '';
        $file = $this->getTranslationFileName();

        return "{$namespace}{$file}.{$key}";
    }

    /**
     * Get the file name that holds the URI translations.
     *
     * @return string The translation file name
     */
    protected function getTranslationFileName(): string
    {
        return 'routes';
    }
}
