<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * Class City
 *
 * @package App\Models
 * @mixin IdeHelperCity
 */
class City extends TranslatableModel
{
    use HasSlug;
    use HasFactory;
    use HasTranslations;

    public $translatable = [
        'title',
    ];
    protected $fillable = [
        'region_id',
        'country_id',
        'title',
        'slug',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function places()
    {
        return $this->hasMany(Place::class, 'city_id');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }


    public function asChoose()
    {
        return [
            'id' => $this->id,
            'region_id' => $this->region_id,
            'country_id' => $this->region_id,
            'title' => $this->title,
            'country_title' => $this->country->title,
            'region_title' => $this->region->title,
            'value' => $this->id,
            'text' => $this->title . ' (' . $this->region->title . ')',
        ];
    }
}
