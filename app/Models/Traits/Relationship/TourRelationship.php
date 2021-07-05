<?php

namespace App\Models\Traits\Relationship;

use App\Models\Accommodation;
use App\Models\Direction;
use App\Models\Place;
use App\Models\PriceItem;
use App\Models\TourFood;
use App\Models\TourGroup;
use App\Models\TourInclude;
use App\Models\TourPlan;
use App\Models\TourSchedule;
use App\Models\TourSubject;
use App\Models\TourType;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait TourRelationship
{
    /**
     * @return BelongsToMany
     */
    public function directions()
    {
        return $this->belongsToMany(Direction::class, 'tours_directions', 'tour_id', 'direction_id');
    }

    /**
     * @return BelongsToMany
     */
    public function places()
    {
        return $this->belongsToMany(Place::class, 'tours_places', 'tour_id', 'place_id');
    }

    /**
     * @return BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(TourGroup::class, 'tours_tour_groups', 'tour_id', 'group_id');
    }

    /**
     * @return BelongsToMany
     */
    public function types()
    {
        return $this->belongsToMany(TourType::class, 'tours_tour_types', 'tour_id', 'type_id');
    }

    /**
     * @return BelongsToMany
     */
    public function subjects()
    {
        return $this->belongsToMany(TourSubject::class, 'tours_subjects', 'tour_id', 'subject_id');
    }

    /**
     * @return HasMany
     */
    public function plan_items()
    {
        return $this->hasMany(TourPlan::class);
    }

    /**
     * @return HasMany
     */
    public function schedule_items()
    {
        return $this->hasMany(TourSchedule::class);
    }

    /**
     * @return HasMany
     */
    public function tour_includes()
    {
        return $this->hasMany(TourInclude::class);
    }

    /**
     * @return HasMany
     */
    public function food_items()
    {
        return $this->hasMany(TourFood::class);
    }

    /**
     * @return HasMany
     */
    public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }

    /**
     * @return HasMany
     */
    public function price_items()
    {
        return $this->hasMany(PriceItem::class);
    }
}
