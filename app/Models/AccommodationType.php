<?php

namespace App\Models;

use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class AccommodationType extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;
    use HasSlug;
    use UseSelectBox;

    public $translatable = [
        'description',
    ];


    protected $fillable = [
        'title',
        'short_title',
        'slug',
        'description',
    ];

    protected $appends = [
        'slug_key',
    ];


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }


    public function getSlugKeyAttribute()
    {
        return str_replace('-', '_', $this->slug);
    }

    public static function toSelectBox(
        $text_field = 'title',
        $value_field = 'slug',
        $value_key = 'value',
        $text_key = 'text'
    ) {
        return self::query()->get(['title', 'short_title', 'slug', 'description'])
            ->map(function ($item) {
                return [
                    'value' => $item->slug_key,
                    'text' => json_prepare($item->title),
                    'short_title' => json_prepare($item->short_title),
                    'description' => json_prepare($item->description),
                ];
            });
    }
}
