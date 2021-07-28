<?php

namespace App\Models\Traits\Relationship;

use App\Models\City;
use App\Models\Country;
use App\Models\Direction;
use App\Models\Region;
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

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
