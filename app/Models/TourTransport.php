<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class TourTransport extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = [
        'text',
        'title',
    ];

    protected $fillable = [
        'tour_id',
        'transport_id',
        'title',
        'text',
        'position',
    ];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    public function transport(): BelongsTo
    {
        return $this->belongsTo(Transport::class);
    }

    public function getTextAttribute()
    {
        return !empty($this->transport) ? $this->transport->text : $this->getTranslation('text', $this->getLocale());
    }

    public function getTitleAttribute()
    {
        $locale = $this->getLocale();
        $title = $this->attributes['title'] ?? '';
        $title = !empty($title) ? json_decode($title, true) : [];
        $prefix = $title[$locale] ?? ($title['uk'] ?? '');
        return !empty($this->transport) ? trim($this->transport->title . ' ' . $prefix) : '-';
    }
}
