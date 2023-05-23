<?php


namespace App\Models\Traits\Attributes;


trait MenuItemAttribute
{
    public function getParentMenuAttribute()
    {
        return $this->menu->title;
    }

    public function getUrlAttribute()
    {
        return $this->page->url ?? url($this->slug);
    }
}
