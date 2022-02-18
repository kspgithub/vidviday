<?php

namespace App\Models;

use App\Models\Traits\Scope\JsonLikeScope;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class LandingPlace extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;
    use HasTranslatableSlug;
    use JsonLikeScope;
    use UseSelectBox;
    use UsePublishedScope;

    public $translatable = [
        'title',
        'description',
        'slug',
    ];

    protected $fillable = [
        'title',
        'description',
        'slug',
        'published',
        'lat',
        'lng',
    ];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
        'published' => 'boolean',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Места посадки
     *
     * @return BelongsToMany
     */
    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tours_landings', 'landing_id', 'tour_id');
    }

    public function asSelectBox($text_field = 'title', $value_field = 'id', $text_key = 'text', $value_key = 'value')
    {
        return [$value_key => $this->{$value_field}, $text_key => $this->{$text_field}];
    }


}
