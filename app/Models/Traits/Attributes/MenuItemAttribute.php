<?php


namespace App\Models\Traits\Attributes;


trait MenuItemAttribute
{
    public function getParentMenuAttribute()
    {
        return $this->menu->title;
    }
}
