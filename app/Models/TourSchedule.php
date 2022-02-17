<?php

namespace App\Models;

use App\Models\Traits\Attributes\TourScheduleAttribute;
use App\Models\Traits\Methods\TourScheduleMethod;
use App\Models\Traits\Scope\TourScheduleScope;
use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class TourSchedule extends Model
{
    use HasFactory;
    use SoftDeletes;
    use UsePublishedScope;
    use TourScheduleAttribute;
    use TourScheduleScope;
    use TourScheduleMethod;

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
        'places_available',
        'places_booked',
        'places_reserved',
        'places_payed',
        'places_new',
        'places_yesterday',
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


}
