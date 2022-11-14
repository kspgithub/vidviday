<?php

namespace App\Models;

use App\Lib\WayForPay\PurchaseAbstract;
use App\Lib\WayForPay\PurchaseCertificate;
use App\Models\Contracts\Purchasable;
use App\Models\Traits\UsePaymentOnline;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class OrderCertificate extends Model implements Purchasable
{
    use SoftDeletes;
    use UsePaymentOnline;

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

    public const PAYMENT_PENDING = 0;

    public const PAYMENT_COMPLETE = 1;

    public const PAYMENT_RETURNED = 2;

    protected static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            $model->order_number = Str::padLeft($model->id, 5, '0');
            $model->save();
        });
    }

    public static function statuses()
    {
        return [
            self::STATUS_NEW => __('New'),
            self::STATUS_PROCESSING => __('Processing'),
            self::STATUS_PENDING_PAYMENT => __('Pending Payment'),
            self::STATUS_PAYED => __('Payed'),
            self::STATUS_COMPLETED => __('Completed'),
            self::STATUS_MAINTENANCE => __('Maintenance'),
            self::STATUS_PENDING_REJECT => __('Pending Reject'),
            self::STATUS_REJECTED => __('Rejected'),
        ];
    }

    public static function types()
    {
        return [
            self::TYPE_SUM => 'Сума',
            self::TYPE_TOUR => 'Мандрівка',
        ];
    }

    public static function formats()
    {
        return [
            self::FORMAT_PRINTED => 'Друкований',
            self::FORMAT_ELECTRONIC => 'Електронний',
        ];
    }

    public static function designs()
    {
        return [
            self::DESIGN_CLASSIC => 'Класичний',
            self::DESIGN_HEART => 'Серце',
        ];
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
        'payment_data',
        'comment',
    ];

    protected $casts = [
        'places' => 'integer',
        'price' => 'integer',
        'sum' => 'integer',
        'packing' => 'boolean',
        'payment_data' => 'array',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function transactions()
    {
        return $this->morphMany(PurchaseTransaction::class, 'model');
    }

    public function calcPrice(): int
    {
        $total = 0;

        if ($this->type === self::TYPE_SUM) {
            $total += $this->sum;
        } else {
            if ($this->tour) {
                $total += $this->tour->price * $this->places;
            }
        }

        if ($this->packing) {
            $total += $this->packingItem ? $this->packingItem->price : 0;
        }

        return $total;
    }

    public function getTotalPriceAttribute(): int
    {
        return $this->calcPrice();
    }

    public function getTitleAttribute(): string
    {
        $title = 'Cертификат на ';
        if ($this->type == self::TYPE_SUM) {
            $title .= 'сумму '.$this->sum.$this->currency;
        } else {
            $title .= 'мандрівку '.$this->tour->title;
        }

        return $title;
    }

    public function purchaseWizard(): PurchaseAbstract
    {
        return new PurchaseCertificate($this);
    }
}
