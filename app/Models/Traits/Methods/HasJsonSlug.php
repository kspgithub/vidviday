<?php

namespace App\Models\Traits\Methods;

use Illuminate\Database\Eloquent\Builder;

trait HasJsonSlug
{
    public function scopeWhereHasSlug(Builder $query, $slug, bool $strict = true)
    {
        if ($strict) {
            return $query->whereJsonContains('slug->' . getLocale(), $slug);
        } else {
            return $query->where(function ($sq) use ($slug) {
                $first = true;
                $locales = siteLocales();
                foreach ($locales as $locale) {
                    if ($first) {
                        $sq->whereJsonContains('slug->' . $locale, $slug);
                        $first = false;
                    } else {
                        $sq->orWhereJsonContains('slug->' . $locale, $slug);
                    }
                }
            });
        }
    }

    public static function existBySlug(string $slug, bool $strict = true)
    {
        return self::whereHasSlug($slug, $strict)->count() > 0;
    }

    public static function findBySlug(string $slug, bool $strict = true)
    {
        return self::whereHasSlug($slug, $strict)->first();
    }

    public static function findBySlugOrFail(string $slug, bool $strict = true)
    {
        return self::whereHasSlug($slug, $strict)->firstOrFail();
    }


    public function getLocaleBySlug($slug)
    {
        $translations = $this->getTranslations('slug');
        foreach ($translations as $locale => $locale_slug) {
            if ($locale_slug == $slug) {
                return $locale;
            }
        }
        return 'uk';
    }

    public function checkSlugLocale($slug)
    {
        $translations = $this->getTranslations('slug');
        $locale = getLocale();
        if (empty($translations[$locale]) || $translations[$locale] !== $slug) {
            $slug_locale = $this->getLocaleBySlug($slug);
            app()->setLocale($slug_locale);
            session()->put('locale', $slug_locale);
            $this->setLocale($slug_locale);
        }
    }

    public function getUrlByLocale($locale): string
    {
        $translations = $this->getTranslations('slug');
        return !empty($translations[$locale]) ? '/' . $translations[$locale] : '';
    }

    public function getLocaleLinks()
    {
        $locales = $this->locales ?? siteLocales();
        $links = [];
        foreach ($locales as $locale) {
            $url = $this->getUrlByLocale($locale);
            if (!empty($url)) {
                if (in_array($url, $links)) {
                    $links[$locale] = $url . '?lang=' . $locale;
                } else {
                    $links[$locale] = $url;
                }

            }
        }
        return $links;
    }
}
