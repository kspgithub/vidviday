<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperOrderCertificate
 */
class OrderCertificate extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const STATUS_NEW = 0;
    public const STATUS_PROCESSING = 1;
    public const STATUS_PENDING_PAYMENT = 2;
    public const STATUS_PAYED = 3;
    public const STATUS_COMPLETED = 4;
    public const STATUS_MAINTENANCE = 5;
    public const STATUS_PENDING_REJECT = 6;
    public const STATUS_REJECTED = 7;

    public const TYPE_SUM = 'sum';
    public const TYPE_TOUR = 'tour';

    public const FORMAT_PRINTED = 'printed';
    public const FORMAT_ELECTRONIC = 'electronic';

    public const DESIGN_CLASSIC = 'classic';
    public const DESIGN_HEART = 'heart';

    protected static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            $model->order_number = Str::padLeft($model->id, 5, '0');
            $model->save();
        });
    }

    protected $fillable = [
        'bitrix_id',
        'user_id',
        'tour_id',
        'status',
        'order_number',
        'type',
        'design',
        'format',
        'first_name',
        'last_name',
        'phone',
        'email',
        'first_name_recipient',
        'last_name_recipient',
        'sum',
        'price',
        'currency',
        'packing',
        'packing_type',
        'places',
        'payment_type',
        'payment_status',
        'comment',
    ];

    protected $casts = [
        'places' => 'integer',
        'price' => 'integer',
        'sum' => 'integer',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function packingItem()
    {
        return $this->belongsTo(Packing::class, 'packing_type', 'slug');
    }

    public function calcPrice()
    {
        $total = 0;

        if ($this->type === self::TYPE_SUM) {
            $total += $this->sum;
        } else {
            if ($this->tour) {
                $total += ($this->tour->price + $this->tour->commission) * $this->places;
            }
        }

        if ($this->packing) {
            $total += $this->packingItem ? $this->packingItem->price : 0;
        }

        return $total;
    }
}
