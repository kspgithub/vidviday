<?php

namespace App\Models\Traits\Relationship;

use App\Models\Order;
use App\Models\Tour;

trait UserRelationship
{

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id')->orderBy('created_at', 'desc');
    }


    public function tourHistory()
    {
        return $this->belongsToMany(Tour::class, 'tour_views')->orderByPivot('created_at', 'desc');
    }

    public function tourFavourites()
    {
        return $this->belongsToMany(Tour::class, 'tour_favourites');
    }
}
