<?php

namespace App\Models\Traits\Relationship;

use App\Models\Direction;
use App\Models\Tour;

trait PlaceRelationship
{
    public function tours()
    {
        return $this->belongsToMany(Tour::class);
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }
}
