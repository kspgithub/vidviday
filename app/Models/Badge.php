<?php

namespace App\Models;

use App\Models\Traits\HasSlug;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Badge extends TranslatableModel
{
    use HasFactory;
    use HasSlug;
    use HasTranslations;
    use UseSelectBox;

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

    protected $hidden = [
        'id',
        'pivot',
        'created_at',
        'updated_at',
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
