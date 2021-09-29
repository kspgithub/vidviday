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


    public function shortInfo()
    {
        return (object)[
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'commission' => $this->commission,
            'currency' => $this->currency,
            'rating' => $this->rating,
            'testimonials_count' => $this->testimonials_count,
            'duration' => $this->duration,
            'nights' => $this->nights,
            'main_image' => $this->main_image,
            'slug' => $this->slug,
            'url' => $this->url,
        ];
    }

    public function isChildrenFree()
    {
        $discount = $this->discounts->where('children')->first();
        return $discount && $discount->type === 1 && (int)$discount->price === 100;
    }

    public function isYoungChildrenFree()
    {
        $discount = $this->discounts->where('category', '=', 'children_young')->first();
        return $discount && $discount->type === 1 && (int)$discount->price === 100;
    }

    public function isOlderChildrenFree()
    {
        $discount = $this->discounts->where('category', '=', 'children_older')->first();
        return $discount && $discount->type === 1 && (int)$discount->price === 100;
    }
}
