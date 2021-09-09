<?php

namespace App\Models;

use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin IdeHelperDiscount
 */
class Discount extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;
    use HasSlug;
    use UseSelectBox;


    public const TYPE_VALUE = 0;
    public const TYPE_PERCENT = 1;


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public $translatable = [
        'title',
    ];


    protected $fillable = [
        "title",
        "type",
        "slug",
        'price',
        'currency',
        'start_date',
        'end_date',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
        'price' => 'float',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'start_date',
        'end_date',
    ];


    /**
     * Tours
     *
     * @return BelongsToMany
     */
    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tours_discounts', 'tour_id', 'discount_id');
    }


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }
}
