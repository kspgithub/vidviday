<?php

namespace App\Models\Traits\Attributes;

use Illuminate\Support\Str;

trait UserAttributes
{
    public function getNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    public function getRoleAttribute()
    {
        return $this->roles->first()->name;
    }

    public function getInitialsAttribute()
    {
        $initials = Str::upper(Str::substr($this->first_name, 0, 1) . Str::substr($this->last_name, 0, 1));
        return $initials ?: 'N/A';
    }
}
