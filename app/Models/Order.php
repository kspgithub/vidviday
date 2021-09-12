<?php

namespace App\Models;

use App\Models\Traits\Relationship\OrderRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperOrder
 */
class Order extends Model
{
    use HasFactory;
    use OrderRelationship;

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
        'children' => 'boolean',
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
