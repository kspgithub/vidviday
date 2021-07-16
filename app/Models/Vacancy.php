<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * Class Vacancy
 *
 * @package App\Models
 * @mixin IdeHelperVacancy
 */
class Vacancy extends Model
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
        'staff_id',
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

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
