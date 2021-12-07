<?php

namespace App\Models\Traits\Methods;


use Illuminate\Database\Eloquent\Builder;

trait HasJsonSlug
{

    public function scopeWhereHasSlug(Builder $query, $slug)
    {
        return $query->whereJsonContains('slug->' . getLocale(), $slug)->orWhereJsonContains('slug->uk', $slug);
    }

    public static function existBySlug(string $slug)
    {
        return self::whereHasSlug($slug)->count() > 0;
    }

    public static function findBySlug(string $slug)
    {
        return self::whereHasSlug($slug)->first();
    }

    public static function findBySlugOrFail(string $slug)
    {
        return self::whereHasSlug($slug)->firstOrFail();
    }

}
