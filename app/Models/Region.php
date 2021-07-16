<?php

namespace App\Models;

use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * Class Region
 *
 * @package App\Models
 * @mixin IdeHelperRegion
 */
class Region extends Model
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

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
