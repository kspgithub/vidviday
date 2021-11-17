<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperOrderTransport
 */
class OrderTransport extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const STATUS_NEW = 'new';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'user_id',
        'status',
        'first_name',
        'last_name',
        'email',
        'phone',
        'viber',
        'route',
        'start_date',
        'end_date',
        'duration',
        'places',
        'age_group',
        'comment',
    ];

    protected $casts = [
        'age_group'=>'array',
        'start_date'=>'date:d.m.Y',
        'end_date'=>'date:d.m.Y',
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
