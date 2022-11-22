<?php

namespace App\Models\Traits\Methods;

use App\Models\Tour;
use App\Models\TourSchedule;
use App\Models\TourVoting;
use App\Models\User;
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
        $full_title = $this->title;
        $price_title = $this->title . " ($this->price $this->currency)";

        if ($this->commission > 0) {
            $full_title .= " ($this->price $this->currency + $this->commission $this->currency)";
        } else {
            $full_title .= " ($this->price $this->currency)";
        }


        return (object)[
            'id' => $this->id,
            'title' => $this->title,
            'price_title' => json_prepare($price_title),
            'full_title' => json_prepare($full_title),
            'price' => $this->price,
            'commission' => $this->commission,
            'accomm_price' => $this->accomm_price,
            'currency' => $this->currency,
            'rating' => $this->rating,
            'testimonials_count' => $this->testimonials_count ?? 0,
            'testimonials_avg_rating' => $this->testimonials_avg_rating ?? 0,
            'votings_count' => $this->votings->filter(fn($q) => $q->where('status', TourVoting::STATUS_PUBLISHED))->count(),
            'duration' => $this->duration,
            'nights' => $this->nights,
            'time' => $this->nights,
            'format_duration' => $this->format_duration,
            'main_image' => $this->main_image,
            'slug' => $this->slug,
            'url' => $this->url,
            'tour_manager' => $this->tour_manager ? $this->tour_manager->shortInfo() : null,
            'guides' => $this->guides,
            'corporate_includes' => $this->corporate_includes,
            'active_tabs' => $this->active_tabs,
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
        $discount = $this->discounts->where('category', '=', 'children_free')->first();
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

        $foodItems = $this->foodItems->filter(fn($fi) => !!$fi->food)->all();

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
        $requestSchedule = (int)request()->get('schedule');

        if(!$this->relationLoaded('scheduleItems')) {
            $this->loadMissing([
                'scheduleItems' => fn($q) => $q->inFuture()
                    ->filter($filter)
            ]);
//        $schedules = $query->get()->filter(fn(TourSchedule $value, $key) => $value->id === $requestSchedule || $value->places_available > 0);
        }
        return TourSchedule::transformForBooking($this->scheduleItems);
    }


    public function userCanEditTour(User $user)
    {
        $staff_ids = $user->staffs()->pluck('id')->toArray();
        $tourManager = $this->manager;
        $manager_id = !empty($tourManager) ? $tourManager->id : 0;
        return $user->isAdmin() || ($user->isTourManager() && in_array($manager_id, $staff_ids));
    }
}
