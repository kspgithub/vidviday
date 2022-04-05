<?php

namespace App\Models\Traits\Attributes;

use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

trait TourScheduleAttribute
{
    /**
     * Дата начала
     * @return string
     */
    public function getStartTitleAttribute()
    {
        if ($this->start_date) {
            return $this->start_date->translatedFormat('D') . ', ' . $this->start_date->format('d.m.Y');
        }
        return '';
    }

    /**
     * Дата проведения
     * @return string
     */
    public function getTitleAttribute()
    {
        if ($this->start_date && $this->end_date) {
            if ($this->start_date->month === $this->end_date->month && $this->start_date->year === $this->end_date->year &&
                $this->start_date->translatedFormat('D') !== $this->end_date->translatedFormat('D')) {
                return Str::ucfirst($this->start_date->translatedFormat('D')) . ' - ' .
                    Str::ucfirst($this->end_date->translatedFormat('D')) .
                    ', ' . $this->start_date->format('d') . ' - ' . $this->end_date->format('d.m.Y');
            }
            return $this->start_date->format('d.m.Y') . ' - ' . $this->end_date->format('d.m.Y');
        }
        return '';
    }

    /**
     * Кол-во новых мест
     * @return int
     */
    public function getPlacesNewAttribute()
    {
        $total = 0;
        $orders = $this->orders->whereIn('status', [Order::STATUS_NEW])->all();
        /**
         * @var Order $order
         */
        foreach ($orders as $order) {
            $total += $order->total_places;
        }
        return $total;
    }

    /**
     * Кол-во забронированных мест
     * @return int
     */
    public function getPlacesBookedAttribute()
    {
        $total = 0;
        $orders = $this->orders->whereIn('status', [Order::STATUS_BOOKED, Order::STATUS_DEPOSIT, Order::STATUS_PAYED, Order::STATUS_COMPLETED])->all();
        /**
         * @var Order $order
         */
        foreach ($orders as $order) {
            $total += $order->total_places;
        }
        return $total;
    }

    /**
     * Количество проплаченных мест
     * @return int
     */
    public function getPlacesPayedAttribute()
    {
        $total = 0;
        $orders = $this->orders->whereIn('status', [Order::STATUS_DEPOSIT, Order::STATUS_PAYED, Order::STATUS_COMPLETED])->all();
        /**
         * @var Order $order
         */
        foreach ($orders as $order) {
            $total += $order->total_places;
        }
        return $total;
    }

    /**
     * @return int
     */
    public function getPlacesReservedAttribute()
    {
        $total = 0;
        $orders = $this->orders->whereIn('status', [Order::STATUS_RESERVE])->all();
        /**
         * @var Order $order
         */
        foreach ($orders as $order) {
            $total += $order->total_places;
        }
        return $total;
    }

    /**
     * @return int
     */
    public function getPlacesYesterdayAttribute()
    {
        $total = 0;
        $orders = $this->orders->all();
        /**
         * @var Order $order
         */
        foreach ($orders as $order) {
            if ($order->created_at->greaterThan(Carbon::yesterday()->startOfDay()) && $order->created_at->lessThan(Carbon::yesterday()->endOfDay())) {
                $total += $order->total_places;
            }
        }
        return $total;
    }

    public function getPlacesAvailableAttribute()
    {
        return $this->places - $this->places_booked;
    }

    public function getPriceTitleAttribute()
    {
        $price = ceil($this->price);


        $title = "Ціна: {$price} грн.";
        if ($this->commission > 0) {
            $commission = ceil($this->commission);
            $title .= " | {$commission} грн.";
        }
        return $title;
    }


    public function getManagerAttribute()
    {
        return ($this->tour && $this->tour->manager) ? $this->tour->manager->shortInfo() : null;
    }

}
