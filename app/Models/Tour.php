<?php

namespace App\Models;

use App\Models\Traits\Attributes\TourAttribute;
use App\Models\Traits\Methods\HasJsonSlug;
use App\Models\Traits\Methods\TourMethods;
use App\Models\Traits\Relationship\TourRelationship;
use App\Models\Traits\Scope\JsonLikeScope;
use App\Models\Traits\Scope\TourScope;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseNormalizeMedia;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Tour extends TranslatableModel implements HasMedia
{
    use SoftDeletes;
    use HasFactory;
    use HasTranslations;
    use HasJsonSlug;
    use InteractsWithMedia;
    use UseNormalizeMedia;
    use UsePublishedScope;
    use TourRelationship;
    use TourAttribute;
    use TourMethods;
    use TourScope;
    use HasTranslatableSlug;
    use UseSelectBox;
    use JsonLikeScope;

    const FORMAT_DAYS = 0;
    const FORMAT_TIME = 1;

    public $translatable = [
        'title',
        'slug',
        'text',
        'short_text',
        'hutsul_fun_title',
        'hutsul_fun_text',
        'seo_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'contact',
    ];

    protected $fillable = [
        'manager_id',
        'bitrix_id',
        'bitrix_manager_id',
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
        'nights',
        'price',
        'commission',
        'accomm_price',
        'currency',
        'rating',
        'video',
        'similar',
        'hutsul_fun_on',
        'hutsul_fun_title',
        'hutsul_fun_text',
        'contact',
        'locales',
        'show_map',
        'duration_format',
        'time',
        'transport_on',
    ];

    protected $casts = [
        'published' => 'bool',
        'duration' => 'int',
        'price' => 'integer',
        'commission' => 'integer',
        'accomm_price' => 'integer',
        'similar' => 'array',
        'locales' => 'array',
    ];

    protected $appends = [
        'main_image',
        'mobile_image',
        'url',
        'format_duration',
    ];

    protected $hidden = [
        'text',
        'seo_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'media',
        'bitrix_id',
        'bitrix_manager_id',
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

        self::updating(function (self $model) {
            if (empty($model->short_text)) {
                $model->short_text = Str::limit(strip_tags($model->text), 500);
            }

            if ($model->isDirty(['price', 'accomm_price'])) {
                foreach ($model->orders as $order) {
                    if ($order->group_type === 0) {
                        $order->recalculatePrice();
                    }
                }
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


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug')
            ->preventOverwrite();
    }

    public function scopeWhereHasSlug(Builder $query, $slug, bool $strict = true)
    {
        if ($strict) {
            $locale = getLocale();
            return $query->whereJsonContains('locales', $locale)->whereJsonContains('slug->' . $locale, $slug);
        } else {
            return $query->where(function ($sq) use ($slug) {
                $first = true;
                $locales = siteLocales();
                foreach ($locales as $locale) {
                    if ($first) {
                        $sq->where(fn($ssq) => $ssq->whereJsonContains('locales', $locale)->whereJsonContains('slug->' . $locale, $slug));
                        $first = false;
                    } else {
                        $sq->orWhere(fn($ssq) => $ssq->whereJsonContains('locales', $locale)->whereJsonContains('slug->' . $locale, $slug));
                    }
                }
            });
        }
    }

    public function getFormatDurationAttribute()
    {
        if($this->duration_format === self::FORMAT_DAYS) {
            return $this->duration.__('tours-section.days-letter') . ($this->nights > 0 && $this->nights !== $this->duration ? '/ '.$this->nights.'н' : '');
        }

        if($this->duration_format === self::FORMAT_TIME) {
            return $this->time.__('tours-section.hours-letter');
        }
    }
}
