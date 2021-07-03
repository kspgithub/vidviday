<?php

namespace App\Models\Traits\Relationship;

use App\Models\Place;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait DirectionRelationship
{
    /**
     * @return HasMany
     */
    public function places()
    {
        return $this->hasMany(Place::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tours()
    {
        return $this->belongsToMany(Tour::class);
    }
}
