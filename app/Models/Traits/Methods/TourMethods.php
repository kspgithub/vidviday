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

        if (!empty($this->similar)) {
            $similar = implode(', ', $this->similar);
            $query = Tour::search()->whereIn('id', $this->similar)->orderByRaw("FIELD(id,  $similar)");
            if ($count > 0) {
                $query->take($count);
            }

            return $query->get();
        }
        return collect([]);
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

    public function asSelectBox()
    {
        return [
            'id' => $this->id,
            'text' => $this->title . ', ' . $this->price . ' ' . $this->currency,
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
