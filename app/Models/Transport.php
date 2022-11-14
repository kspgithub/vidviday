<?php

namespace App\Models;

use App\Models\Traits\HasImage;
use App\Models\Traits\HasSlug;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseNormalizeMedia;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Transport extends TranslatableModel implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;
    use InteractsWithMedia;
    use UseNormalizeMedia;
    use HasImage;
    use HasSlug;
    use UseSelectBox;

    public $translatable = [
        'title',
        'text',
    ];

    protected $fillable = [
        'title',
        'text',
        'slug',
        'published',
        'image',
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
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }

    public function asSelectBox(
        $value_key = 'id',
        $text_key = 'text'
    )
    {
        return [
            $value_key => $this->id,
            $text_key => $this->title,
        ];
    }
}
