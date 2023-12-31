<?php

namespace App\Models;

use App\Models\Traits\Methods\HasJsonSlug;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseNormalizeMedia;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Traits\HasSlug;
use App\Models\Traits\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Practice extends TranslatableModel implements HasMedia
{
    use HasTranslatableSlug;
    use HasTranslations;
    use UsePublishedScope;
    use HasJsonSlug;
    use UseSelectBox;
    use InteractsWithMedia;
    use UseNormalizeMedia;

    public $translatable = [
        'title',
        'text',
        'short_text',
        'slug',
        'seo_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_text',
    ];

    protected $fillable = [
        'staff_id',
        'title',
        'short_text',
        'seo_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_text',
        'text',
        'video',
        'slug',
        'published',
        'similar',
    ];

    protected $appends = [
        'url',
    ];

    protected $casts = [
        'published' => 'boolean',
        'similar' => 'array'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug')
            ->preventOverwrite();
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function getUrlAttribute()
    {
        $slug = $this->slug;
        return url(!empty($slug) ? route('practice.show', $slug) : route('practice.show', $this->id));
    }

    public function getSimilarPracticesAttribute()
    {
        $ids = $this->similar ?? [];
        if (!empty($ids)) {
            return self::query()->whereIn('id', $ids)->get();
        }
        return collect([]);
    }
}
