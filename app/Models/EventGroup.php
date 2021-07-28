<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * Class EventGroup
 *
 * @package App\Models
 * @mixin IdeHelperEventGroup
 */
class EventGroup extends Model
{
    use HasFactory;
    use HasSlug;
    use HasTranslations;
    use UsePublishedScope;

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
    ];

    protected $casts = [
        'published' => 'boolean'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }

    /**
     * @return HasMany
     */
    public function events()
    {
        return $this->hasMany(EventItem::class, 'group_id');
    }
}
