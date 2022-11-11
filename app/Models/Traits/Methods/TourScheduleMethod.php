<?php

namespace App\Models\Traits\Methods;

use App\Models\TourSchedule;
use Illuminate\Database\Eloquent\Collection;

trait TourScheduleMethod
{
    public function totalPlacesByStatus($statuses)
    {
        $places = 0;
        $orders = $this->orders()->whereIn('status', $statuses)->get(['id', 'places', 'children', 'children_older', 'children_young']);
        foreach ($orders as $order) {
            $places += $order->total_places;
        }

        return $places;
    }

    /**
     * @param  TourSchedule[]|Collection  $schedules
     * @return \Illuminate\Support\Collection
     */
    public static function transformForBooking($schedules)
    {
        $items = [];
        foreach ($schedules as $schedule) {
            $schedule->makeHidden(['orders', 'bitrix_id', 'status']);
            $start_date = $schedule->start_date->format('dmY');
            if (empty($items[$start_date])) {
                $items[$start_date] = $schedule;
            } else {
                $items[$start_date]->places += $schedule->places;
                $items[$start_date]->places_new += $schedule->places_new;
                $items[$start_date]->places_available += $schedule->places_available;
                $items[$start_date]->places_booked += $schedule->places_booked;
            }
        }

        return collect(array_values($items));
    }

    public function availableForBooking($places)
    {
        $lastItem = $this;
        $availableItems = self::published()
            ->where('tour_id', $this->tour_id)
            ->whereDate('start_date', $this->start_date)
            ->orderBy('id')->get();

        foreach ($availableItems as $item) {
            if (($item->places_available - $item->places_new) >= $places) {
                return $item;
            }

            $lastItem = $item;
        }

        return $lastItem;
    }

    public function isAutoBookingAvailable($places)
    {
        if ($this->auto_booking) {
            if ($this->auto_limit >= ($this->places_booked + $places)) {
                return true;
            } else {
                $this->auto_booking = false;
                $this->save();
            }
        }

        return false;
    }

    public function shortInfo($additional = [])
    {
        $data = [
            'id' => $this->id,
            'start_title' => $this->start_title,
            'start_date' => $this->start_date->format('d.m.Y'),
            'end_date' => $this->end_date->format('d.m.Y'),
            'title' => $this->title,
            'places' => $this->places,
            'places_available' => $this->places_available,
            'price' => $this->price,
            'accomm_price' => $this->accomm_price,
            'commission' => $this->commission,
            'currency' => $this->currency,
            'published' => $this->published,
        ];
        if (! empty($additional)) {
            foreach ($additional as $attribute) {
                $data[$attribute] = $this->getAttribute($attribute);
            }
        }

        return $data;
    }

    public function asCrmSchedule()
    {
        return $this->shortInfo(['admin_comment', 'duty_comment', 'places', 'auto_booking', 'auto_limit', 'manager']);
    }

    public function asCalendarEvent($event_click = 'url')
    {
        $json = json_encode($this->shortInfo());

        $data = [
            'id' => $this->id,
            'title' => $event_click !== 'url' ? $this->getPriceTitleAttribute() : $this->tour->title,
            'start' => $this->start_date->format('Y-m-d'),
            'end' => $this->end_date->addDays(($this->tour->duration + $this->tour->nights) <= 2 ? 0 : 1)->format('Y-m-d'),
            'className' => $this->places_available >= 10 ? 'have-a-lot' : ($this->places_available >= 2 ? 'still-have' : 'no-have'),
        ];

        if ($event_click !== false) {
            $data['url'] = $event_click === 'order'
                ? "javascript:selectTourEvent({$json})"
                : $this->tour->url;
        }

        return $data;
    }

    public function calculateEndDate()
    {
        $totalDayNights = $this->tour->duration + $this->tour->nights;

        if ($this->tour->duration > $this->tour->nights) {
            $days = floor($totalDayNights / 2);
        } else {
            $days = ceil($totalDayNights / 2);
        }

        return $this->start_date->addDays($days);
    }
}
