<?php

namespace App\Models;

use App\Models\Traits\HasImage;
use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class OurClient extends Model
{
    use HasTranslations;
    use HasSlug;
    use UsePublishedScope;
    use HasImage;


    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'title',
        'slug',
        'image',
        'position',
        'published',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }

    public function imageSize()
    {
        return [
            'width' => 312,
            'height' => 112,
        ];
    }
}
