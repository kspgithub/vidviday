<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserSubscription
 *
 * @package App\Models
 * @mixin IdeHelperUserSubscription
 */
class UserSubscription extends Model
{
    use HasFactory;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    protected $fillable = [
        'status',
        'name',
        'email',
        'bitrix_id',
        'bitrix_contact_id',
        'utm_campaign',
        'utm_content',
        'utm_medium',
        'utm_source',
        'utm_term',
    ];
}
