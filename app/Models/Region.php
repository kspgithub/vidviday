<?php

namespace App\Models;

use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Region extends TranslatableModel
{
    use HasSlug;
    use HasFactory;
    use HasTranslations;
    use UseSelectBox;

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }

    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'country_id',
        'title',
        'slug',
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function places()
    {
        return $this->hasMany(Place::class);
    }
}
