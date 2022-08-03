<?php

namespace App\Models;

use App\Models\Traits\Scope\JsonLikeScope;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Ticket extends TranslatableModel
{

    use HasFactory;
    use HasSlug;
    use HasTranslations;
    use UsePublishedScope;
    use UseSelectBox;
    use JsonLikeScope;

//    public function getRouteKeyName()
//    {
//        return 'slug';
//    }


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

    public function scopeAutocomplete(Builder $query, $search = '')
    {
        $search = strtolower(urldecode(trim($search)));
        $query = $query->published()->with(['region'])
            ->whereRaw('LOWER(title->"$.uk") like ?', '%' . $search . '%')
            ->orWhereRaw('LOWER(title->"$.en") like ?', '%' . $search . '%')
            ->select([
                'id',
                'region_id',
                'title',
                'slug',
            ]);

        if (!empty($search)) {
            $query->addSelect(DB::raw("LOCATE('$search', title) as relevant"))
                ->orderBy('relevant');
        } else {
            $query->addSelect(DB::raw("JSON_EXTRACT(title, '$.uk') AS titleUk"))->orderBy('titleUk');
        }
        return $query;
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

    public function asSelectBox()
    {
        return [
            'id' => $this->id,
            'text' => $this->title . ($this->region ? ' (' . $this->region->title . ')' : ''),
        ];
    }
}
