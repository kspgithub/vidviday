<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseNormalizeMedia;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin IdeHelperFood
 */
class Food extends TranslatableModel implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use HasTranslations;
    use UsePublishedScope;
    use InteractsWithMedia;
    use UseNormalizeMedia;
    use UseSelectBox;


    public $translatable = [
        'title',
        'text',
    ];

    protected $fillable = [
        'title',
        'text',
        'price',
        'currency',
        'slug',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('normal')
            ->width(840)
            ->height(480);

        $this->addMediaConversion('thumb')
            ->width(315)
            ->height(180);
    }


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            ->saveSlugsTo('slug');
    }

    public static function toSelectBox(
        $text_field = 'title',
        $value_field = 'id',
        $value_key = 'value',
        $text_key = 'text'
    )
    {
        return self::query()->get(['id', 'title', 'price', 'currency'])
            ->map(function ($item) use ($value_field, $text_field, $value_key, $text_key) {
                return [$value_key => $item->{$value_field}, $text_key => $item->title . ', ' . $item->price . $item->currency];
            });
    }
}
