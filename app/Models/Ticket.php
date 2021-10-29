<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseSelectBox;
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
class Ticket extends TranslatableModel
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
    ];

    protected $fillable = [
        'title',
        'price',
        'region_id',
        'currency',
        'text',
        'slug',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
        'price' => 'float'
    ];


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }


    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tours_tickets', 'ticket_id', 'tour_id');
    }

    public static function toSelectBox()
    {
        return self::query()->with('region')
            ->orderBy('region_id')
            ->orderBy('slug')
            ->get()->map(function (Ticket $item) {
                return [
                    'value' => $item->id,
                    'text' => $item->title . ' (' . $item->region->title . ')',
                ];
            });
    }
}
