<?php

namespace App\Models\Traits\Scope;

trait UsePublishedScope
{
    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }
}
