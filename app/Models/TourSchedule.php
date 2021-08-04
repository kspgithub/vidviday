<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    ];

    protected $appends = [
        'title',
    ];

    protected $dates = [
        'start_date',
        'end_date',
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


    public function getTitleAttribute()
    {
        if ($this->start_date->month === $this->end_date->month && $this->start_date->year === $this->end_date->year &&
            $this->start_date->translatedFormat('D') !== $this->end_date->translatedFormat('D')) {
            return Str::ucfirst($this->start_date->translatedFormat('D')). ' - ' .
                Str::ucfirst($this->end_date->translatedFormat('D')).
                ', '.$this->start_date->format('d') . ' - ' . $this->end_date->format('d.m.Y');
        }
        return $this->start_date->format('d.m.Y').' - '.$this->end_date->format('d.m.Y');
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

    public function asCalendarEvent($event_click)
    {
        $json = json_encode([
            'id'=>$this->id,
            'title'=>$this->title,
            'places'=>$this->places,
            'price'=>$this->price,
            'commission'=>$this->commission,
        ]);

        return [
            'id'=>$this->id,
            'title'=> $event_click === 'order' ? $this->getPriceTitleAttribute() : $this->tour->title,
            'start'=> $this->start_date->format('Y-m-d'),
            'end'=> $this->end_date->format('Y-m-d'),
            'className'=> $this->places >= 10 ? 'have-a-lot' : ($this->places >= 2 ? 'still-have' : 'no-have'),
            'url'=> $event_click === 'order'
                ? "javascript:selectTourEvent({$json})"
                : $this->tour->url,
        ];
    }
}
