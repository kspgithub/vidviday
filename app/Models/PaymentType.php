<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class PaymentType extends TranslatableModel
{
    public const TYPE_ONLINE = 5;

    use HasSlug;
    use HasTranslations;
    use UsePublishedScope;
    use UseSelectBox;


    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'title',
        'slug',
        'published',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }
}
