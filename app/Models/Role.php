<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

/**
 * Class Role
 *
 * @package App\Models
 * @mixin IdeHelperRole
 */
class Role extends SpatieRole
{
    public static function allNames()
    {
        return self::pluck('name')->toArray();
    }
}
