<?php

namespace App\Models\Traits\Attributes;

trait UserAttributes
{
    public function getNameAttribute()
    {
        return trim($this->first_name .' '. $this->last_name);
    }

    public function getRoleAttribute()
    {
        return $this->roles->first()->name;
    }
}
