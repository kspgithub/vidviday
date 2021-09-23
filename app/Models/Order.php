<?php

namespace App\Models;

use App\Models\Traits\Attributes\OrderAttribute;
use App\Models\Traits\Relationship\OrderRelationship;
use App\Models\Traits\UseOrderConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperOrder
 */
class Order extends TranslatableModel
{
    use HasFactory;
    use OrderRelationship;
    use OrderAttribute;
    use UseOrderConstants;


    protected static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            $model->order_number = Str::padLeft($model->id, 5, '0');
            $model->save();
        });
    }

    public const CONFIRMATION_EMAIL = 1;
    public const CONFIRMATION_VIBER = 2;
    public const CONFIRMATION_PHONE = 3;

    public const GROUP_TEAM = 0;
    public const GROUP_CORPORATE = 0;


    protected $fillable = [
        'user_id',
        'tour_id',
        'schedule_id',
        'status',
        'group_type',
        'start_date',
        'start_place',
        'end_date',
        'end_place',
        'order_number',
        'price',
        'commission',
        'discount',
        'currency',
        'discounts',
        'children',
        'children_young',
        'children_older',
        'tour_title',
        'first_name',
        'last_name',
        'company',
        'phone',
        'viber',
        'places',
        'comment',
        'participants',
        'accommodation',
        'abolition',
        'program_type',
        'tour_plan',
        'group_comment',
        'program_comment',
        'price_include',
        'payment_type',
        'payment_status',
        'confirmation_type',
        'confirmation_status',
        'offer_date',
        'act',
        'invoice',
        'info_sheet',
    ];

    protected $casts = [
        'discounts' => 'array',
        'participants' => 'array',
        'accommodation' => 'array',
        'abolition' => 'array',
        'price_include' => 'array',
        'children' => 'boolean',
        'children_older' => 'integer',
        'children_young' => 'integer',
        'places' => 'integer',
        'price' => 'integer',
        'commission' => 'integer',
        'discount' => 'integer',
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'offer_date',
        'created_at',
        'updated_at',
    ];
}
