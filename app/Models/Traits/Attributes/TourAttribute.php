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
        return url(!empty($this->slug) ? '/' . $this->slug : '');
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
        return $media === null ? asset('img/no-image.png') : $media->getUrl();
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
            return (object)[
                'id' => $type->id,
                'title' => $type->title,
                'items' => $this->tourIncludes->where('type_id', $type->id),
            ];
        }));
    }

    public function getGroupTourLandingsAttribute()
    {
        $landings = [];
        $tourLandings = $this->tourLandings->sortBy('position')->all();

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
        $tourPlaces = $this->tourPlaces->sortBy('position')->all();

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
        $tourTickets = $this->tourTickets->sortBy('position')->all();

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
        $tourAccommodations = $this->tourAccommodations->sortBy('position')->all();

        foreach ($tourAccommodations as $tourAccommodation) {
            $accommodation = $tourAccommodation->accommodation ?: $tourAccommodation;
            $accommodation->original_id = $tourAccommodation->id;
            $accommodation->nights = $tourAccommodation->nights;
            if($tourAccommodation->accommodation) {

            }
            $accommodations[] = $accommodation;
        }
        return collect($accommodations);
    }

    public function getGroupTourTransportAttribute()
    {
        $transports = [];
        $tourTransports = $this->tourTransports->sortBy('position')->all();

        foreach ($tourTransports as $tourTransport) {
            $transport = $tourTransport->transport ?: $tourTransport;
            $transport->original_id = $tourTransport->id;
            if($tourTransport->transport) {
                $transport->title = $tourTransport->title . ' ' . $transport->title;
            }
            $transports[] = $transport;
        }
        return collect($transports);
    }

    public function getGroupTourFoodAttribute()
    {
        $foods = [];
        $foodItems = $this->foodItems->sortBy('position')->all();

        foreach ($foodItems as $tourFood) {
            $food = $tourFood->food ?: $tourFood;
            $food->original_id = $tourFood->id;
            if($tourFood->food) {
                $food->day = $tourFood->day;
                $food->title = $tourFood->title . ' ' . $food->title;
            }
            $foods[] = $food;
        }
        return collect($foods);
    }

    public function getGroupTourDiscountsAttribute()
    {
        $discounts = [];
        $tourDiscounts = $this->tourDiscounts->sortBy('position')->all();

        foreach ($tourDiscounts as $tourDiscount) {
            $discount = $tourDiscount->discount ?: $tourDiscount;
            $discount->original_id = $tourDiscount->id;
            if($tourDiscount->discount) {

            }
            $discounts[] = $discount;
        }
        return collect($discounts);
    }

    public function getGroupFoodItemsAttribute()
    {
        $locale = app()->getLocale();
        $foodItems = $this->foodItems->sortBy('position')->all();

        $days = [];
        foreach ($foodItems as $foodItem) {
            $item = $foodItem->food ?: $foodItem;
            if (!isset($days[$foodItem->day])) {
                $days[$foodItem->day] = (object)[
                    'title' => $foodItem->day . (in_array($locale, ['uk', 'ru']) ? '-й день' : __('day')),
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
            $title[] = !empty($discount->admin_title) ? $discount->admin_title : $discount->title;
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

    public function getFormatDurationAttribute()
    {
        if ($this->duration_format === self::FORMAT_DAYS) {
            if ($this->duration === 1 && !$this->nights) {
                return $this->duration . ' ' . __('tours-section.day');
            } else {

                return $this->duration . __('tours-section.days-letter') . ($this->nights > 0 ? ' / ' . $this->nights . __('tours-section.nights-letter') : '');
            }
        }

        if ($this->duration_format === self::FORMAT_TIME) {
            return $this->time . __('tours-section.hours-letter');
        }
    }
}
