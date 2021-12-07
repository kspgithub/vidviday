<?php

namespace App\Models\Traits\Relationship;

use App\Models\EventItem;
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

    /**
     * @return BelongsToMany
     */
    public function events()
    {
        return $this->belongsToMany(EventItem::class, 'events_directions', 'direction_id', 'event_id');
    }

    public function groupedEvents()
    {
        $groups = [];
        foreach ($this->events as $event) {
            foreach ($event->groups as $group) {
                if (!isset($groups[$group->id])) {
                    $groups[$group->id] = (object)[
                        'id' => $group->id,
                        'title' => $group->title,
                        'slug' => $group->slug,
                        'events' => collect()
                    ];
                }
                $groups[$group->id]->events->push($event);
            }
        }
        return collect(array_values($groups));
    }
}
