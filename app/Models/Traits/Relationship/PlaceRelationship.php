<?php

namespace App\Models\Traits\Relationship;

use App\Models\City;
use App\Models\Country;
use App\Models\Direction;
use App\Models\District;
use App\Models\Region;
use App\Models\Testimonial;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait PlaceRelationship
{
    /**
     * Туры
     *
     * @return BelongsToMany
     */
    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tours_places', 'place_id', 'tour_id');
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * Отзывы к месту
     *
     * @return MorphMany
     */
    public function testimonials()
    {
        return $this->morphMany(Testimonial::class, 'model')->withDepth()->reversed();
    }
}
