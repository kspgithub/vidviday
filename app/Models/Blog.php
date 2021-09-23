<?php

namespace App\Models;

use App\Models\Traits\Attributes\BlogAttribute;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseNormalizeMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin IdeHelperBlog
 */
class Blog extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use HasTranslations;
    use UsePublishedScope;
    use InteractsWithMedia;
    use UseNormalizeMedia;
    use BlogAttribute;

    public $translatable = [
        'title',
        'text',
        'short_text',
        'seo_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];
    protected $fillable = [
        'title',
        'seo_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'text',
        'short_text',
        'slug',
        'published',
    ];
    protected $casts = [
        'published' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();
        /**
         * генерируем короткий текст если он не было передан
         */
        self::creating(function ($model) {
            if (empty($model->short_text)) {
                $model->short_text = Str::limit(strip_tags($model->text), 500);
            }
        });

        self::updating(function ($model) {
            if (empty($model->short_text)) {
                $model->short_text = Str::limit(strip_tags($model->text), 500);
            }
        });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('normal')
            ->width(840)
            ->height(480);

        $this->addMediaConversion('thumb')
            ->width(315)
            ->height(180);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->singleFile();

        $this->addMediaCollection('pictures')
            ->acceptsMimeTypes(['image/jpeg', 'image/png']);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            ->saveSlugsTo('slug');
    }
}

