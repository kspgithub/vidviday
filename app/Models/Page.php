<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseNormalizeMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

/**
 * Class Page
 * Страницы сайта
 *
 * @package App\Models
 * @mixin IdeHelperPage
 */
class Page extends TranslatableModel implements HasMedia
{
    use HasFactory;
    use UsePublishedScope;
    use HasTranslations;
    use InteractsWithMedia;
    use UseNormalizeMedia;

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('normal')
            ->width(840)
            ->height(480);

        $this->addMediaConversion('thumb')
            ->width(315)
            ->height(180);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public $translatable = [
        'title',
        'text',
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
        'slug',
        'published',
        'sidebar',
        'sidebar_items',
    ];

    protected $casts = [
        'published' => 'boolean',
        'sidebar' => 'boolean',
        'sidebar_items' => 'array',
    ];


    public function sections()
    {
        return $this->hasMany(PageSection::class, 'page_id')->orderBy('position');
    }
}
