<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TourPlace extends Model
{
    use HasFactory;
    use HasTranslations;

    public $timestamps = false;

    protected $table = 'tours_places';

    public $translatable = [
        'text',
        'title',
    ];

    protected $fillable = [
        'tour_id',
        'place_id',
        'title',
        'text',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function getTextAttribute()
    {
        $locale = $this->getLocale();
        $text = $this->attributes['text'] ?? '';
        $text = !empty($text) ? json_decode($text, true) : [];
        return !empty($this->place) ? $this->place->text : ($text[$locale] ?? '');
    }

    public function getTitleAttribute()
    {
        $locale = $this->getLocale();
        $title = $this->attributes['title'] ?? '';
        $title = !empty($title) ? json_decode($title, true) : [];
        $prefix = $title[$locale] ?? ($title['uk'] ?? '');
        return trim(($this->place->title ?? '') . ' ' . $prefix);
    }


    /* Get Media from parent */
    public function hasMedia(string $collectionName = 'default')
    {
        return $this->place ? $this->place->hasMedia($collectionName) : false;
    }
    public function getMedia(string $collectionName = 'default', $filters = [])
    {
        return $this->place ? $this->place->getMedia($collectionName, $filters) : collect();
    }
}
