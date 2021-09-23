<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    use UsePublishedScope;


    protected $fillable = [
        'tour_id',
        'start_date',
        'end_date',
        'places',
        'price',
        'commission',
        'currency',
        'published',
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
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
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

    public function getStartTitleAttribute()
    {
        if ($this->start_date) {
            return $this->start_date->translatedFormat('D') . ', ' . $this->start_date->format('d.m.Y');
        }
        return '';
    }


    public function getTitleAttribute()
    {
        if ($this->start_date && $this->end_date) {
            if ($this->start_date->month === $this->end_date->month && $this->start_date->year === $this->end_date->year &&
                $this->start_date->translatedFormat('D') !== $this->end_date->translatedFormat('D')) {
                return Str::ucfirst($this->start_date->translatedFormat('D')) . ' - ' .
                    Str::ucfirst($this->end_date->translatedFormat('D')) .
                    ', ' . $this->start_date->format('d') . ' - ' . $this->end_date->format('d.m.Y');
            }
            return $this->start_date->format('d.m.Y') . ' - ' . $this->end_date->format('d.m.Y');
        }
        return '';
    }

    public function asCalendarEvent($event_click)
    {
        $json = json_encode([
            'id' => $this->id,
            'start_title' => $this->start_title,
            'title' => $this->title,
            'places' => $this->places,
            'price' => $this->price,
            'commission' => $this->commission,
        ]);

        return [
            'id' => $this->id,
            'title' => $event_click === 'order' ? $this->getPriceTitleAttribute() : $this->tour->title,
            'start' => $this->start_date->format('Y-m-d'),
            'end' => $this->end_date->format('Y-m-d'),
            'className' => $this->places >= 10 ? 'have-a-lot' : ($this->places >= 2 ? 'still-have' : 'no-have'),
            'url' => $event_click === 'order'
                ? "javascript:selectTourEvent({$json})"
                : $this->tour->url,
        ];
    }

    public function getPriceTitleAttribute()
    {
        $price = ceil($this->price);


        $title = "Ціна: {$price} грн.";
        if ($this->commission > 0) {
            $commission = ceil($this->commission);
            $title .= " | {$commission} грн.";
        }
        return $title;
    }

    public function scopeInFuture(Builder $query)
    {
        return $query->published()->whereDate('start_date', '>=', Carbon::now()->addDays(1))->orderBy('start_date');
    }


    public function scopeBetween(Builder $query, $start, $end)
    {
        return $query->where(function ($sq) use ($start, $end) {
            $sq->where(function ($q) use ($start, $end) {
                return $q->whereDate('start_date', '>=', $start->toDateString())
                    ->whereDate('start_date', '<=', $end->toDateString());
            })
                ->orWhere(function ($q) use ($start, $end) {
                    return $q->whereDate('end_date', '>=', $start->toDateString())
                        ->whereDate('end_date', '<=', $end->toDateString());
                })
                ->orWhere(function ($q) use ($start, $end) {
                    return $q->whereDate('start_date', '<', $start->toDateString())
                        ->whereDate('end_date', '>', $end->toDateString());
                });
        });
    }

    public function scopeFilter(Builder $query, $params = [])
    {
        $query
            ->when(!empty($params['date_from']), function (Builder $q) use ($params) {
                return $q->whereDate('start_date', '>=', Carbon::createFromFormat('d.m.Y', $params['date_from']));
            })
            ->when(!empty($params['date_to']), function (Builder $q) use ($params) {
                return $q->whereDate('end_date', '<=', Carbon::createFromFormat('d.m.Y', $params['date_from']));
            })
            ->when(!empty($params['duration_from']), function (Builder $q) use ($params) {
                return $q->whereHas('tour', function ($sq) use ($params) {
                    return $sq->where('duration', '>=', $params['duration_from']);
                });
            })
            ->when(!empty($params['duration_to']), function (Builder $q) use ($params) {
                return $q->whereHas('tour', function ($sq) use ($params) {
                    return $sq->where('duration', '<=', $params['duration_to']);
                });
            })
            ->when(!empty($params['price_from']), function (Builder $q) use ($params) {
                return $q->where('price', '>=', $params['price_from']);
            })
            ->when(!empty($params['price_to']), function (Builder $q) use ($params) {
                return $q->where('price', '<=', $params['price_to']);
            })
            ->when(!empty($params['direction']), function (Builder $q) use ($params) {
                return $q->whereHas('tour', function ($sq) use ($params) {
                    return $sq->whereHas('directions', function (Builder $ssq) use ($params) {
                        $ids = array_filter(explode(',', $params['direction']));
                        $ssq->whereIn('id', $ids);
                    });
                });
            })
            ->when(!empty($params['type']), function (Builder $q) use ($params) {
                return $q->whereHas('tour', function ($sq) use ($params) {
                    return $sq->whereHas('types', function (Builder $ssq) use ($params) {
                        $ids = array_filter(explode(',', $params['type']));
                        $ssq->whereIn('id', $ids);
                    });
                });
            })
            ->when(!empty($params['subject']), function (Builder $q) use ($params) {
                return $q->whereHas('tour', function ($sq) use ($params) {
                    return $sq->whereHas('subjects', function (Builder $ssq) use ($params) {
                        $ids = array_filter(explode(',', $params['subject']));
                        $ssq->whereIn('id', $ids);
                    });
                });
            });

        return $query;
    }
}
