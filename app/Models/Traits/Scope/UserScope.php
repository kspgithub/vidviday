<?php

namespace App\Models\Traits\Scope;

trait UserScope
{
    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeOnlyDeactivated($query)
    {
        return $query->whereStatus(self::STATUS_INACTIVE);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeOnlyActive($query)
    {
        return $query->whereStatus(self::STATUS_ACTIVE);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeOnlyBlocked($query)
    {
        return $query->whereStatus(self::STATUS_BLOCKED);
    }
}
