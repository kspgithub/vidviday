<?php

namespace App\Models;

use App\Models\Traits\UseNormalizeMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class TourAccommodation extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;

    public $translatable = [
        'text',
        'title',
    ];


    protected $fillable = [
        'tour_id',
        'accommodation_id',
        'title',
        'text',
    ];


    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class, 'accommodation_id');
    }

    public function types()
    {
        return $this->belongsToMany(AccommodationType::class, 'tour_accomm_types', 'accomm_id', 'type_id');
    }


    public function media()
    {
        return $this->hasMany(Media::class, 'model_id', 'accommodation_id')
            ->where('model_type', Accommodation::class);
    }

    public function getTextAttribute()
    {
        $locale = $this->getLocale();
        $text = $this->attributes['text'] ?? '';
        $text = !empty($text) ? json_decode($text, true) : [];
        return !empty($this->accommodation) ? $this->accommodation->text : ($text[$locale] || '');
    }

    public function getTitleAttribute()
    {
        $locale = $this->getLocale();
        $title = $this->attributes['title'] ?? '';
        $title = !empty($title) ? json_decode($title, true) : [];
        $prefix = $title[$locale] ?? ($title['uk'] ?? '');
        return !empty($this->accommodation) ? trim($this->accommodation->title . ' ' . $prefix) : '-';
    }
}
