<?php

namespace App\Models;

use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Discount extends Model
{
    use HasFactory;
    use HasTranslations;
    use HasSlug;
    use UseSelectBox;



    public function getRouteKeyName()
    {
        return 'slug';
    }

    public $translatable = [
        'title',
    ];


    protected $fillable = [
        "title",
        "slug",
        'price',
        'percentage',
        'currency',
        'start_date',
        'end_date',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
        'price' => 'float',
        'percentage' => 'float',
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
        return $this->belongsToMany(Tour::class, 'discounts_tours', 'tour_id', 'discount_id');
    }


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }
}
