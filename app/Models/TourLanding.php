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

    public function media()
    {
        return $this->hasMany(Media::class, 'model_id', 'landing_id')
            ->where('model_type', LandingPlace::class);
    }


    public function getTextAttribute()
    {
        return !empty($this->landing) ? $this->landing->text : $this->getTranslation('text', $this->getLocale());
    }

    public function getTitleAttribute()
    {
        $locale = $this->getLocale();
        $title = $this->attributes['title'] ?? '';
        $title = !empty($title) ? json_decode($title, true) : [];
        $prefix = $title[$locale] ?? ($title['uk'] ?? '');
        return !empty($this->landing) ? trim($this->landing->title . ' ' . $prefix) : '-';
    }
}
