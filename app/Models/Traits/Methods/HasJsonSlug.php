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
            return $query->whereJsonContains('slug->' . getLocale(), $slug)->orWhereJsonContains('slug->uk', $slug);
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

}
