<?php

namespace App\Models\Traits\Attributes;

use Illuminate\Support\Str;

trait TourScheduleAttribute
{

    public function getStartTitleAttribute()
    {
        if ($this->start_date) {
            return $this->start_date->translatedFormat('D') . ', ' . $this->start_date->format('d.m.Y');
        }
        return '';
    }


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
}
