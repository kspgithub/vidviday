<?php

namespace App\Models;

use App\Models\Traits\Attributes\TourAttribute;
use App\Models\Traits\Relationship\TourRelationship;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseNormalizeMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * Class Tour
 * Тур
 *
 * @package App\Models
 * @mixin IdeHelperTour
 */
class Tour extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    use UseNormalizeMedia;
    use UsePublishedScope;
    use TourRelationship;
    use TourAttribute;
    use HasSlug;

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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->singleFile();

        $this->addMediaCollection('mobile')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->singleFile();

        $this->addMediaCollection('pictures')
            ->acceptsMimeTypes(['image/jpeg', 'image/png']);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('normal')
            ->width(840)
            ->height(480)
            ->performOnCollections('main', 'pictures');

        $this->addMediaConversion('thumb')
            ->width(315)
            ->height(180)
            ->performOnCollections('main', 'pictures');

    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

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
        'duration',
        'price',
        'currency',
        'new',
        'bestseller',
    ];

    protected $casts = [
        'published' => 'bool',
        'new' => 'bool',
        'bestseller' => 'bool',
        'duration' => 'int',
        'price' => 'float',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['id', 'title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }
}
