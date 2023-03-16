<?php

namespace App\Models;

use App\Models\Traits\Methods\HasJsonSlug;
use App\Models\Traits\Scope\JsonLikeScope;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseNormalizeMedia;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Traits\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Page extends TranslatableModel implements HasMedia
{
    use HasFactory;
    use HasJsonSlug;
    use UsePublishedScope;
    use HasTranslatableSlug;
    use HasTranslations;
    use InteractsWithMedia;
    use UseNormalizeMedia;
    use UseSelectBox;
    use JsonLikeScope;

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
            ->saveSlugsTo('slug')
            ->preventOverwrite();
    }

    public function getUrlAttribute()
    {
        return !empty($this->slug) ? Str::startsWith($this->slug, 'http',) ? $this->slug : ('/' . $this->slug) : '';
    }


    public function getRouteKeyName()
    {
        return 'key';
    }

    public $translatable = [
        'title',
        'text',
        'slug',
        'seo_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_text',
    ];

    protected $fillable = [
        'title',
        'seo_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_text',
        'text',
        'key',
        'slug',
        'main',
        'published',
        'sidebar',
        'sidebar_items',
        'staff_id',
        'video',
    ];

    protected $casts = [
        'main' => 'boolean',
        'published' => 'boolean',
        'sidebar' => 'boolean',
        'sidebar_items' => 'array',
    ];


    public function sections()
    {
        return $this->hasMany(PageSection::class, 'page_id')->orderBy('position');
    }

    public function contact()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public static function urlByKey($key)
    {
        $page = Page::where('key', $key)->first(['id', 'title', 'slug', 'key']);
        if ($page) {
            return $page->url;
        }
        return '/' . $key;
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class, 'page_id')->orderBy('sort_order');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function isAvailableFor(User|null $user)
    {
        if(!$this->published) {
            return false;
        }

        $roles = $this->roles->pluck('name')->toArray();

        if($roles) {
            return $user && $user->hasRole([$roles]);
        }

        return true;
    }

    public function popularTours()
    {
        return $this->morphMany(PopularTour::class, 'model');
    }

    public function asSelectBox()
    {
        return [
            'id' => $this->id,
            'text' => $this->title,
        ];
    }
}
