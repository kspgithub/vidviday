<?php

namespace App\Models\Traits\Relationship;

use App\Models\Direction;
use App\Models\EventGroup;
use App\Models\EventItem;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait EventRelationship
{

    /**
     * Направления
     *
     * @return BelongsToMany
     */
    public function directions()
    {
        return $this->belongsToMany(Direction::class, 'events_directions', 'event_id', 'direction_id');
    }

    /**
     * Группы
     *
     * @return BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(EventGroup::class, 'events_groups', 'event_id', 'group_id');
    }

}
