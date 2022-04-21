<?php

namespace App\Models;

use App\Models\Traits\Attributes\OrderAttribute;
use App\Models\Traits\Methods\OrderMethods;
use App\Models\Traits\Relationship\OrderRelationship;
use App\Models\Traits\Scope\OrderScope;
use App\Models\Traits\UseOrderConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Order extends TranslatableModel implements Auditable
{
    use HasFactory;
    use OrderRelationship;
    use OrderAttribute;
    use UseOrderConstants;
    use OrderScope;
    use SoftDeletes;
    use AuditableTrait;
    use OrderMethods;

    protected static function boot()
    {
        parent::boot();

        self::creating(function (Order $order) {
            $order->price = $order->price ?: 0;
            $order->commission = $order->commission ?: 0;
        });

        self::created(function (Order $order) {
            self::disableAuditing();
            $order->order_number = Str::padLeft($order->id, 5, '0');
            $order->save();
            self::enableAuditing();
        });

        self::updating(function (Order $order) {
            $forbiddenStatuses = [Order::STATUS_BOOKED, Order::STATUS_DEPOSIT, Order::STATUS_PAYED, Order::STATUS_COMPLETED];
            if ($order->status !== Order::STATUS_RESERVE && $order->isOverloaded() && in_array($order->status, $forbiddenStatuses)) {
                $status = in_array($order->getOriginal('status'), $forbiddenStatuses) ? Order::STATUS_RESERVE : $order->getOriginal('status');
                $order->status = $status;
            }
            if($order->payment_get > 0 && $order->payment_get < $order->total_price){
                $order->status = Order::STATUS_DEPOSIT;
            }
            if($order->payment_get <= 0){
                $order->status = Order::STATUS_PAYED;
            }
        });
    }

    public const STATUS_NEW = 'new';
    public const STATUS_BOOKED = 'booked'; // Бронь
    public const STATUS_NOT_SENT = 'not-sent'; // Не надіслано
    public const STATUS_INTERESTED = 'interested';  // Цікавились
    public const STATUS_RESERVE = 'reserve';  // Резерв
    public const STATUS_DEPOSIT = 'deposit'; // Завдаток
    public const STATUS_PAYED = 'payed'; // Оплата
    public const STATUS_PENDING_CANCEL = 'pending-cancel'; // Очікує скасування
    public const STATUS_CANCELED = 'canceled'; // Скасовано
    public const STATUS_COMPLETED = 'completed'; // Виконано

    public const CONFIRMATION_EMAIL = 1;
    public const CONFIRMATION_VIBER = 2;
    public const CONFIRMATION_PHONE = 3;

    public const GROUP_TEAM = 0;
    public const GROUP_CORPORATE = 1;

    public const PAYMENT_PENDING = 0;
    public const PAYMENT_COMPLETE = 1;
    public const PAYMENT_RETURNED = 2;

    public const PROGRAM_EXISTS = 0;
    public const PROGRAM_CUSTOM = 1;

    protected $fillable = [
        'user_id',
        'contact_id',
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
        'accomm_price',
        'discount',
        'currency',
        'discounts',
        'children',
        'children_young',
        'children_older',
        'without_place',
        'without_place_count',
        'tour_title',
        'first_name',
        'middle_name',
        'last_name',
        'birthday',
        'company',
        'phone',
        'email',
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
        'additional',
        'payment_fop',
        'payment_tov',
        'payment_office',
        'admin_comment',
        'duty_comment',
        'is_tour_agent',
        'agency_data',
        'utm_data',
        'payment_data',
        'auto',
    ];

    protected $casts = [
        'discounts' => 'array',
        'participants' => 'array',
        'accommodation' => 'array',
        'abolition' => 'array',
        'price_include' => 'array',
        'children' => 'boolean',
        'without_place' => 'boolean',
        'additional' => 'boolean',
        'children_older' => 'integer',
        'children_young' => 'integer',
        'places' => 'integer',
        'without_place_count' => 'integer',
        'price' => 'integer',
        'commission' => 'integer',
        'accomm_price' => 'integer',
        'discount' => 'integer',
        'start_date' => 'date:d.m.Y',
        'end_date' => 'date:d.m.Y',
        'offer_date' => 'date:d.m.Y',
        'birthday' => 'date:d.m.Y',
        'is_tour_agent' => 'boolean',
        'agency_data' => 'array',
        'utm_data' => 'array',
        'payment_data' => 'array',
        'auto' => 'boolean',
    ];

    protected $appends = [
        'total_places',
        'total_price',
        'tour_manager',
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'birthday',
        'offer_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $hidden = [
        'payment_fop',
        'payment_tov',
        'payment_office',
        'payment_data',
        'admin_comment',
        'agency_data',
        'utm_data',
    ];
}
