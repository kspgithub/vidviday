<?php

namespace App\Models\Traits\Attributes;

use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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
     * Дата начала
     * @return string
     */
    public function getEndTitleAttribute()
    {
        if ($this->end_date) {
            return $this->end_date->translatedFormat('D') . ', ' . $this->end_date->format('d.m.Y');
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
            $diff = $this->end_date->diffInDays($this->start_date);

            $start_date = $this->start_date->format('d.m.Y');
            $end_date = $this->end_date->format('d.m.Y');

            $start_day = $this->start_date->format('d');

            $start_day_name = Str::ucfirst($this->start_date->translatedFormat('D'));
            $end_day_name = Str::ucfirst($this->end_date->translatedFormat('D'));

            if ($diff > 0 && $start_day_name !== $end_day_name) {
                return $start_day_name . ' - ' .
                    $end_day_name .
                    ', ' . $start_day . ' - ' . $end_date;
            }

            if($start_date === $end_date) {
                return $start_day_name . ', ' . $start_date;
            } else {
                return $start_date . ' - ' . $end_date;
            }
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
     * Количество мест в резерве
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
     * Количество доступных мест
     * @return int
     */
    public function getPlacesAvailableAttribute()
    {
        return max($this->places - $this->places_booked, 0);
    }

    public function getPriceTitleAttribute()
    {
        $price = ceil($this->price);

        $title = "Ціна: {$price} грн.";
        if (Auth::user()?->isTourAgent() && $this->commission > 0) {
            $commission = ceil($this->commission);
            $title .= " | {$commission} грн.";
        }
        return $title;
    }


    public function getManagerAttribute()
    {
        return ($this->tour && $this->tour->manager) ? $this->tour->manager->shortInfo() : null;
    }

    public function getEndDateAttribute($endDate)
    {
        return $endDate ? Carbon::parse($endDate) : $this->calculateEndDate();
    }

    public function getCurrencyTitleAttribute()
    {
        return $this->currencyModel->title;
    }
}
