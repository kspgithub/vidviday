<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * Class TourPlan
 *
 * @package App\Models
 * @mixin IdeHelperTourPlan
 */
class TourPlan extends Model
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;
    use HasSlug;

    public $translatable = [
        'title',
        'text',
    ];
    
    protected $fillable = [
        'tour_id',
        'title',
        'text',
        'slug',
        'lat',
        'lng',
        'published',
    ];
    protected $casts = [
        'published' => 'boolean'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return BelongsTo
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }
}
