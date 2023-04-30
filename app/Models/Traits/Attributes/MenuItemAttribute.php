<?php


namespace App\Models\Traits\Attributes;


use Illuminate\Support\Str;

trait MenuItemAttribute
{
    public function getParentMenuAttribute()
    {
        return $this->menu->title;
    }

    public function getUrlAttribute()
    {
        return $this->model?->url ?: (!empty($this->slug) ? Str::startsWith($this->slug, 'http',) ? $this->slug : ('/' . $this->slug) : '');
    }
}
