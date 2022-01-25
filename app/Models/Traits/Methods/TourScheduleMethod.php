<?php

namespace App\Models\Traits\Methods;

use App\Models\Order;

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
}
