<?php

namespace App\Models\Traits\Scope;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;

trait JsonLikeScope
{
    public static function prepareLikeValue($value)
    {
        return trim(mb_str_replace(' ', '', mb_str_replace('+', '', mb_str_replace("'", '', mb_strtolower($value)))));
    }

    public static function prepareLikeSelectQuery($field, $locale)
    {
        $parts = explode('.', $field);

        if (count($parts) > 1) {
            $table = $parts[0];
            $field = $parts[1];

            return "REPLACE(REPLACE(REPLACE(LOWER(JSON_UNQUOTE(JSON_EXTRACT(`$table`.`$field`, '$.\"$locale\"'))), '\'', ''), '+', ''), ' ', '')";
        }

        return "REPLACE(REPLACE(REPLACE(LOWER(JSON_UNQUOTE(JSON_EXTRACT(`$field`, '$.\"$locale\"'))), '\'', ''), '+', ''), ' ', '')";
    }

    /**
     * @param  QueryBuilder|EloquentBuilder|Relation  $query
     * @param  string  $field
     * @param  string  $value
     * @param  array  $locales
     * return QueryBuilder|EloquentBuilder
     */
    private function buildJsonLikeQuery($query, $field, $value, $locales = [])
    {
        if (empty($locales)) {
            $locales = siteLocales();
        }
        $value = self::prepareLikeValue($value);

        foreach ($locales as $locale) {
            $query->orWhereRaw(self::prepareLikeSelectQuery($field, $locale)." LIKE '$value'");
        }

        return $query;
    }

    /**
     * @param  QueryBuilder|EloquentBuilder|Relation  $builder
     * @param  string  $field
     * @param  string  $value
     * @param  array  $locales
     * return QueryBuilder|EloquentBuilder
     */
    public function scopeJsonLike($builder, $field, $value, $locales = [])
    {
        return $builder->where(fn ($sq) => $this->buildJsonLikeQuery($sq, $field, $value, $locales));
    }

    /**
     * @param  QueryBuilder|EloquentBuilder|Relation  $builder
     * @param  string  $field
     * @param  string  $value
     * @param  array  $locales
     * return QueryBuilder|EloquentBuilder
     */
    public function scopeOrJsonLike($builder, $field, $value, $locales = [])
    {
        return $builder->orWhere(fn ($sq) => $this->buildJsonLikeQuery($sq, $field, $value, $locales));
    }

    /**
     * @param  QueryBuilder|EloquentBuilder|Relation  $builder
     * @param $search
     * return QueryBuilder|EloquentBuilder
     */
    public function scopeOrderByRelevant($builder, $search, $field = 'title', $locales = [])
    {
        $search = self::prepareLikeValue($search);
        if (empty($locales)) {
            $locales = siteLocales();
        }
        $locates = [];
        foreach ($locales as $key => $locale) {
            $addSelect = self::prepareLikeSelectQuery($field, $locale);
            $loc = "LOCATE('$search', $addSelect)";
            $builder->addSelect(DB::raw("CASE WHEN $loc > 0 THEN $loc ELSE 1000 END AS relevant_$locale"));
            $locates[] = DB::raw($loc);
        }
        $builder->where(function ($sq) use ($locates) {
            foreach ($locates as $key => $locate) {
                if ($key === 0) {
                    $sq->where($locate, '>', 0);
                } else {
                    $sq->orWhere($locate, '>', 0);
                }
            }
        });
        foreach ($locales as $locale) {
            $builder->orderBy("relevant_$locale");
        }

        return $builder;
    }

    public function scopeOrderByJsonDefault($builder, $field = 'title', $locales = [])
    {
        if (empty($locales)) {
            $locales = siteLocales();
        }
        foreach ($locales as $locale) {
            $builder->orderBy("{$field}->{$locale}");
        }

        return $builder;
    }

    public function scopeJsonAutocomplete($builder, $search, $select = null, $with = null, $field = 'title', $locales = [])
    {
        if (empty($locales)) {
            $locales = siteLocales();
        }

        $search = strtolower(urldecode(trim($search)));
        if (! empty($with)) {
            $builder->with($with);
        }
        if (! empty($select)) {
            $builder->select($select);
        }

        $builder->where(fn ($q) => $q->jsonLike($field, "%$search%", $locales));

        if (! empty($search)) {
            $builder->orderByRelevant($search);
        } else {
            $builder->orderByJsonDefault($field, $locales);
        }

        return $builder;
    }
}
