<?php

namespace App\Models;

use App\Models\Traits\Attributes\TourScheduleAttribute;
use App\Models\Traits\Methods\TourScheduleMethod;
use App\Models\Traits\Scope\TourScheduleScope;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\StandardUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourSchedule extends Model
{
    use HasFactory;
    use SoftDeletes;
    use UsePublishedScope;
    use TourScheduleAttribute;
    use TourScheduleScope;
    use TourScheduleMethod;
    use StandardUploadFile;

    const STATUS_PLANNED = 0;

    const STATUS_WAITING = 1;

    const STATUS_PERFORMED = 2;

    const STATUS_SUCCESS = 3;

    const STATUS_FAIL = 4;

    protected $fillable = [
        'status',
        'tour_id',
        'bitrix_id',
        'start_date',
        'end_date',
        'places',
        'places_yesterday',
        'price',
        'commission',
        'accomm_price',
        'currency',
        'published',
        'comment',
        'bus',
        'guide',
        'duty_transport',
        'duty_call',
        'duty_comment',
        'admin_comment',
        'auto_booking',
        'auto_limit',
        'places_yd_updated_at',
        'info_sheet',
    ];

    protected $casts = [
        'published' => 'boolean',
        'auto_booking' => 'boolean',
        'price' => 'integer',
        'commission' => 'integer',
        'accomm_price' => 'integer',
        'start_date' => 'date:d.m.Y',
        'end_date' => 'date:d.m.Y',
    ];

    protected $appends = [
        'title',
        'start_title',
        'end_title',
        'places_available',
        'places_booked',
        'places_reserved',
        'places_payed',
        'places_new',
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'published',
        'bus',
        'guide',
        'duty_transport',
        'duty_call',
        'duty_comment',
        'admin_comment',
        'auto_booking',
        'auto_limit',
    ];

    public static function boot()
    {
        parent::boot();

        self::updating(function (self $model) {
            if ($model->isDirty(['price', 'accomm_price'])) {
                foreach ($model->orders as $order) {
                    if ($order->group_type === 0) {
                        $order->recalculatePrice();
                    }
                }
            }
        });
    }

    /**
     * Тур
     *
     * @return BelongsTo
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    /**
     * Заказы
     *
     * @return HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'schedule_id');
    }

    public function currencyModel()
    {
        return $this->belongsTo(Currency::class, 'currency', 'iso');
    }
}
