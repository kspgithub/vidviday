<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * Class Ticket
 *
 * @package App\Models
 * @mixin IdeHelperTicket
 */
class Ticket extends Model
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
        "priority",
    ];

    protected $fillable = [
        'title',
        'priority',
        'text',
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
