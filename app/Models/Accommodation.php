<?php

namespace App\Models;

use App\Models\Traits\HasTranslatableSlug;
use App\Models\Traits\Methods\HasJsonSlug;
use App\Models\Traits\Scope\JsonLikeScope;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseNormalizeMedia;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Accommodation extends TranslatableModel implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    use UseNormalizeMedia;
    use UsePublishedScope;
    use HasTranslatableSlug;
    use HasJsonSlug;
    use UseSelectBox;
    use JsonLikeScope;

    public $translatable = [
        'title',
        //'title_where',
        'text',
        'slug',
    ];

    public $fillable = [
        'title',
        //'title_where',
        'text',
        'country_id',
        'region_id',
        'city_id',
        'slug',
        'published',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('normal')
            ->width(840)
            ->height(480);

        $this->addMediaConversion('thumb')
            ->width(315)
            ->height(180);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function scopeAutocomplete(Builder $query, $search = '')
    {
        $search = strtolower(urldecode(trim($search)));
        $query = $query->published()->with(['region'])
            ->whereRaw('LOWER(title->"$.uk") like ?', '%'.$search.'%')
            ->orWhereRaw('LOWER(title->"$.en") like ?', '%'.$search.'%')
            ->orWhere('title->en', 'LIKE', "%$search%")
            ->select([
                'id',
                'country_id',
                'region_id',
                'city_id',
                'title',
                'slug',
            ]);

        if (! empty($search)) {
            $query->addSelect(DB::raw("LOCATE('$search', title) as relevant"))
                ->orderBy('relevant');
        } else {
            $query->addSelect(DB::raw("JSON_EXTRACT(title, '$.uk') AS titleUk"))->orderBy('titleUk');
        }

        return $query;
    }

    public function asSelectBox(
        $value_key = 'id',
        $text_key = 'text'
    ) {
        return [
            $value_key => $this->id,
            $text_key => $this->title.($this->region ? ' ('.$this->region->title.')' : ''),
        ];
    }
}
