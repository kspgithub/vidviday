<?php

namespace App\Models\Traits\Attributes;

use Illuminate\Support\Str;

trait OrderAttribute
{
    public function getStartTitleAttribute()
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

        if ($this->start_date) {
            return $this->start_date->translatedFormat('D') . ', ' . $this->start_date->format('d.m.Y');
        }
        return '';
    }

    public function getEventTitleAttribute()
    {
        if ($this->start_date) {
            return $this->start_date->translatedFormat('D') . ', ' . $this->start_date->format('d.m.Y');
        }
        return '';
    }

    public function getDurationAttribute()
    {
        if ($this->tour_id > 0) {
            return $this->tour->duration;
        }

        if ($this->start_date && $this->end_date) {
            return $this->start_date->diffInDays($this->end_date);
        }

        return 0;
    }

    public function getTotalPlacesAttribute()
    {
        $total = $this->places;
        if ($this->children) {
            $total += $this->children_young;
            $total += $this->children_older;
        }
        return $total;
    }

    public function getTotalChildrenAttribute()
    {
        $total = 0;
        if ($this->children) {
            $total += $this->children_young;
            $total += $this->children_older;
        }
        return $total;
    }

    public function getTotalPriceAttribute()
    {
        return $this->price - $this->discount + $this->commission;
    }


    public function getPaymentTitleAttribute()
    {
        return $this->payment ? $this->payment->title : '';
    }

    public function getTourManagerAttribute()
    {
        return $this->tour && $this->tour->manager ? $this->tour->manager->first->shortInfo() : null;
    }
}
