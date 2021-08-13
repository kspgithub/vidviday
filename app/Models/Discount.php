<?php

namespace App\Models;

use App\Models\Traits\Attributes\DiscountAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Discount extends Model
{
    use HasFactory;
    use HasTranslations;
    use HasSlug;
    use DiscountAttribute;



    public function getRouteKeyName()
    {
        return 'slug';
    }

    public $translatable = [
        'title',
    ];


    protected $fillable = [
        "title",
        'price',
        'currency',
        'duration',
        'model_nameable_id',
        'model_nameable_type',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
        'duration' => 'int',
        'price' => 'float',
    ];


    /**
     * Get the parent model_nameable model (tour or others).
     */
    public function model_nameable()
    {
        return $this->morphTo();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }
}
