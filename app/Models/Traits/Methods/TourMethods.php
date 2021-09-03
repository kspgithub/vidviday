<?php

namespace App\Models\Traits\Methods;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

trait TourMethods
{

    /**
     * Похожие туры
     * @param int $count
     * @return Tour[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|Collection
     */
    public function getSimilarTours(int $count = 4)
    {
        $direction_ids = $this->directions->pluck('id')->toArray();
        $subjects_ids = $this->subjects->pluck('id')->toArray();
        $types_ids = $this->types->pluck('id')->toArray();

        return Tour::search()
            ->whereHas('directions', function (Builder $q) use ($direction_ids) {
                $q->whereIn('id', $direction_ids);
            })
            ->whereHas('subjects', function (Builder $q) use ($subjects_ids) {
                $q->whereIn('id', $subjects_ids);
            })
            ->whereHas('types', function (Builder $q) use ($types_ids) {
                $q->whereIn('id', $types_ids);
            })
            ->take($count)->get();
    }


    public static function findBySlug(string $slug)
    {
        return Tour::query()->where('slug', 'like', '%"' . $slug . '"%')->first();
    }

    public static function findBySlugOrFail(string $slug)
    {
        return Tour::query()->where('slug', 'like', '%"' . $slug . '"%')->firstOrFail();
    }
}
