<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class TourLanding extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $table = 'tours_landings';

    public $translatable = [
        'text',
        'title',
    ];


    protected $fillable = [
        'tour_id',
        'landing_id',
        'title',
        'text',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function landing()
    {
        return $this->belongsTo(LandingPlace::class, 'landing_id');
    }

    public function getTextAttribute()
    {
        $locale = $this->getLocale();
        $text = $this->attributes['text'] ?? '';
        $text = !empty($text) ? json_decode($text, true) : [];
        return !empty($this->landing) ? $this->landing->description : ($text[$locale] || '');
    }

    public function getTitleAttribute()
    {
        $locale = $this->getLocale();
        $title = $this->attributes['title'] ?? '';
        $title = !empty($title) ? json_decode($title, true) : [];
        $prefix = $title[$locale] ?? ($title['uk'] ?? '');
        return trim(($this->landing->title ?? '') . ' ' . $prefix);
    }


    /* Get Media from parent */
    public function hasMedia(string $collectionName = 'default')
    {
        return $this->landing ? $this->landing->hasMedia($collectionName) : false;
    }
    public function getMedia(string $collectionName = 'default', $filters = [])
    {
        return $this->landing ? $this->landing->getMedia($collectionName, $filters) : collect();
    }
}
