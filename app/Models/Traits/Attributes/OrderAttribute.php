<?php

namespace App\Models\Traits\Attributes;

use Illuminate\Support\Str;

trait OrderAttribute
{
    public function getStartTitleAttribute()
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
}
