<?php

namespace App\Models\Traits\Methods;

use App\Models\Tour;
use App\Models\TourSchedule;
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
            'full_title' => $this->commission > 0 ? "$this->title ($this->price $this->currency + $this->commission $this->currency)" : "$this->title ($this->price $this->currency)",
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
            'tour_manager' => $this->tour_manager ? $this->tour_manager->shortInfo() : null,
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


    public function calcItems()
    {
        $items = [];

        $foodItems = $this->foodItems()->whereHas('food')->get();

        foreach ($this->priceItems as $priceItem) {
            $items[] = [
                'id' => 'pi_' . $priceItem->id,
                'title' => $priceItem->title,
                'price' => (int)$priceItem->price,
                'currency' => $priceItem->currency,
                'limited' => $priceItem->limited,
                'places' => $priceItem->places,
            ];
        }


        foreach ($this->tickets as $ticket) {
            $items[] = [
                'id' => 't_' . $ticket->id,
                'title' => $ticket->title,
                'price' => (int)$ticket->price,
                'currency' => $ticket->currency,
                'limited' => false,
                'places' => 0,
            ];
        }

        foreach ($foodItems as $foodItem) {
            $items[] = [
                'id' => 'f_' . $foodItem->id,
                'title' => $foodItem->calc_title,
                'price' => $foodItem->food ? (int)$foodItem->food->price : 0,
                'currency' => $foodItem->currency,
                'limited' => false,
                'places' => 0,
            ];
        }

        return $items;
    }


    public function schedulesForBooking($filter = null)
    {
        $query = $this->scheduleItems()->inFuture();
        if (!empty($filter)) {
            $query->filter($filter);
        }
        $schedules = $query->get()->filter(fn (TourSchedule $value, $key) => $value->places_available > 0);
        return TourSchedule::transformForBooking($schedules);
    }
}
