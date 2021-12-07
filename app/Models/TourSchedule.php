<?php

namespace App\Models;

use App\Models\Traits\Attributes\TourScheduleAttribute;
use App\Models\Traits\Scope\TourScheduleScope;
use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * Class TourSchedule
 *
 * @property Carbon|string|null $start_date
 * @property Carbon|string|null $end_date
 * @package App\Models
 * @mixin IdeHelperTourSchedule
 */
class TourSchedule extends Model
{
    use HasFactory;
    use SoftDeletes;
    use UsePublishedScope;
    use TourScheduleAttribute;
    use TourScheduleScope;

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
        'places_booked',
        'price',
        'commission',
        'currency',
        'published',
        'comment',
    ];

    protected $casts = [
        'published' => 'boolean',
        'price' => 'integer',
        'commission' => 'integer',
        'start_date' => 'date:d.m.Y',
        'end_date' => 'date:d.m.Y',
    ];

    protected $appends = [
        'title',
        'start_title',
        'places_available',
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


    public function asCalendarEvent($event_click = 'url')
    {
        $json = json_encode([
            'id' => $this->id,
            'start_title' => $this->start_title,
            'title' => $this->title,
            'places' => $this->places,
            'price' => $this->price,
            'commission' => $this->commission,
        ]);


        $data = [
            'id' => $this->id,
            'title' => $event_click !== 'url' ? $this->getPriceTitleAttribute() : $this->tour->title,
            'start' => $this->start_date->format('Y-m-d'),
            'end' => $this->end_date->format('Y-m-d'),
            'className' => $this->places >= 10 ? 'have-a-lot' : ($this->places >= 2 ? 'still-have' : 'no-have'),
        ];

        if ($event_click !== false) {
            $data['url'] = $event_click === 'order'
                ? "javascript:selectTourEvent({$json})"
                : $this->tour->url;
        }
        return $data;
    }


}
