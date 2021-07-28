<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AgencySubscription
 * Рассылка для турфирм
 *
 * @package App\Models
 * @mixin IdeHelperAgencySubscription
 */
class AgencySubscription extends Model
{
    use HasFactory;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    protected $fillable = [
        'status',
        'name',
        'phone',
        'email',
        'viber',
    ];
}
