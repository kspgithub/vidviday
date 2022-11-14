<?php

namespace App\Models\Traits\Attributes;

use App\Models\IncludeType;
use App\Models\TourPlan;

trait TourAttribute
{
    protected $tourGuides = null;

    protected $tourManager = null;

    public function getUrlAttribute()
    {
        return ! empty($this->slug) ? '/'.$this->slug : '';
    }

    public function getMainImageAttribute()
    {
        $media = $this->getFirstMedia('main');

        // TODO: Заменить на no image
        return $media === null ? asset('img/no-image.png') : $media->getUrl('thumb');
    }

    public function getMobileImageAttribute()
    {
        $media = $this->getFirstMedia('mobile');

        // TODO: Заменить на no image
        return $media === null ? asset('img/no-image.png') : $media->getUrl('thumb');
    }

    public function getTourGuidesAttribute()
    {
        if ($this->tourGuides === null) {
            $this->tourGuides = $this->staff()->onlyExcursionLeaders()->get();
        }

        return $this->tourGuides;
    }

    public function getTourManagerAttribute()
    {
//        if ($this->tourManager === null) {
//            $this->tourManager = $this->staff()->onlyTourManagers()->first();
//        }
//        return $this->tourManager;

        return $this->manager;
    }

    public function getGroupTourIncludesAttribute()
    {
        return collect(IncludeType::all()->map(function ($type) {
            return (object) [
                'id' => $type->id,
                'title' => $type->title,
                'items' => $this->tourIncludes->where('type_id', $type->id),
            ];
        }));
    }

    public function getGroupTourLandingsAttribute()
    {
        $landings = [];
        $tourLandings = $this->tourLandings()->orderBy('position')->get();

        foreach ($tourLandings as $tourLanding) {
            $landing = $tourLanding->landing ?: $tourLanding;
            $landing->original_id = $tourLanding->id;
            $landing->time = $tourLanding->time;
            $landings[] = $landing;
        }

        return collect($landings);
    }

    public function getGroupTourPlacesAttribute()
    {
        $places = [];
        $tourPlaces = $this->tourPlaces()->orderBy('position')->get();

        foreach ($tourPlaces as $tourPlace) {
            $place = $tourPlace->place ?: $tourPlace;
            $place->original_id = $tourPlace->id;
            $places[] = $place;
        }

        return collect($places);
    }

    public function getGroupTourTicketsAttribute()
    {
        $tickets = [];
        $tourTickets = $this->tourTickets()->orderBy('position')->get();

        foreach ($tourTickets as $tourTicket) {
            $ticket = $tourTicket->ticket ?: $tourTicket;
            $ticket->original_id = $tourTicket->id;
            $tickets[] = $ticket;
        }

        return collect($tickets);
    }

    public function getGroupTourAccommodationsAttribute()
    {
        $accommodations = [];
        $tourAccommodations = $this->tourAccommodations()->orderBy('position')->get();

        foreach ($tourAccommodations as $tourAccommodation) {
            $accommodation = $tourAccommodation->accommodation ?: $tourAccommodation;
            $accommodation->original_id = $tourAccommodation->id;
            $accommodation->nights = $tourAccommodation->nights;
            if ($tourAccommodation->accommodation) {
            }
            $accommodations[] = $accommodation;
        }

        return collect($accommodations);
    }

    public function getGroupTourTransportAttribute()
    {
        $transports = [];
        $tourTransports = $this->tourTransports()->orderBy('position')->get();

        foreach ($tourTransports as $tourTransport) {
            $transport = $tourTransport->transport ?: $tourTransport;
            $transport->original_id = $tourTransport->id;
            if ($tourTransport->transport) {
                $transport->title = $tourTransport->title.' '.$transport->title;
            }
            $transports[] = $transport;
        }

        return collect($transports);
    }

    public function getGroupTourFoodAttribute()
    {
        $foods = [];
        $foodItems = $this->foodItems()->orderBy('position')->get();

        foreach ($foodItems as $tourFood) {
            $food = $tourFood->food ?: $tourFood;
            $food->original_id = $tourFood->id;
            if ($tourFood->food) {
                $food->day = $tourFood->day;
                $food->title = $tourFood->title.' '.$food->title;
            }
            $foods[] = $food;
        }

        return collect($foods);
    }

    public function getGroupTourDiscountsAttribute()
    {
        $discounts = [];
        $tourDiscounts = $this->tourDiscounts()->orderBy('position')->get();

        foreach ($tourDiscounts as $tourDiscount) {
            $discount = $tourDiscount->discount ?: $tourDiscount;
            $discount->original_id = $tourDiscount->id;
            if ($tourDiscount->discount) {
            }
            $discounts[] = $discount;
        }

        return collect($discounts);
    }

    public function getGroupFoodItemsAttribute()
    {
        $locale = app()->getLocale();
        $foodItems = $this->foodItems()->orderBy('position')->get();

        $days = [];
        foreach ($foodItems as $foodItem) {
            $item = $foodItem->food ?: $foodItem;
            if (! isset($days[$foodItem->day])) {
                $days[$foodItem->day] = (object) [
                    'title' => $foodItem->day.(in_array($locale, ['uk', 'ru']) ? '-й день' : __('day')),
                    'times' => collect([]),
                ];
            }
            $days[$foodItem->day]->times->add($item);
        }

        return collect($days);
    }

    public function getDiscountTitleAttribute()
    {
        $title = [];
        foreach ($this->discounts as $discount) {
            $title[] = ! empty($discount->admin_title) ? $discount->admin_title : $discount->title;
        }

        return implode('<br> ', $title);
    }

    /**
     * План
     *
     * @return TourPlan
     */
    public function getPlanAttribute()
    {
        return $this->planItems()->firstOrNew(['tour_id' => $this->id]);
    }

    public function getCurrencyTitleAttribute()
    {
        return $this->currencyModel->title;
    }
}
