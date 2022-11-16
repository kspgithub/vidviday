<?php

namespace App\Models\Traits\Scope;

trait UsePublishedScope
{
    public function scopePublished($query)
    {
        return $query->where($this->getTable() . '.published', 1);
    }
}
