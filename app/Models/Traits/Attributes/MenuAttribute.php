<?php


namespace App\Models\Traits\Attributes;

trait MenuAttribute
{
    public function getShortDescriptionAttribute()
    {
        return str_limit($this->description, 35);
    }
}
