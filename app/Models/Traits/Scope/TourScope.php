<?php

namespace App\Models\Traits\Scope;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

trait TourScope
{

    /**
     * Будущие туры
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeInFuture(Builder $query)
    {
        return $query->whereHas('scheduleItems', function (Builder $q) {
            return $q->whereDate('start_date', '>=', Carbon::now());
        });
    }


    public function scopeSearch(Builder $query)
    {
        return $query->inFuture()->published()->with([
            'scheduleItems' => function ($sc) {
                return $sc->whereDate('start_date', '>=', Carbon::now());
            },
            'media' => function ($sc) {
                return $sc->whereIn('collection_name', ['main', 'mobile']);
            },
            'badges'
            ])
            ->withCount(['testimonials']);
    }
}
