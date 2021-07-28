<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * Class Badge
 *
 * @package App\Models
 * @mixin IdeHelperBadge
 */
class Badge extends Model
{
    use HasFactory;
    use HasSlug;
    use HasTranslations;


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'title',
        'color',
        'slug',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tour_badges');
    }
}
