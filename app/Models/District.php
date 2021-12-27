<?php

namespace App\Models;

use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class District extends TranslatableModel
{
    use HasSlug;
    use HasFactory;
    use HasTranslations;
    use UseSelectBox;

    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'region_id',
        'country_id',
        'title',
        'slug',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function places()
    {
        return $this->hasMany(Place::class, 'city_id');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }


    public function asChoose()
    {
        return [
            'id' => $this->id,
            'region_id' => $this->region_id,
            'country_id' => $this->region_id,
            'title' => $this->title,
            'country_title' => $this->country->title,
            'region_title' => $this->region->title,
            'value' => $this->id,
            'text' => $this->title . ' (' . $this->region->title . ')',
        ];
    }

    public static function scopeToSelectBox(
        Builder $query,
                $text_field = 'title',
                $value_field = 'id',
                $value_key = 'value',
                $text_key = 'text'
    )
    {
        return $query->with(['region'])->orderBy('region_id')->orderBy('title')->get(['id', 'title', 'region_id'])
            ->map(function ($item) use ($value_key, $text_key) {
                return [$value_key => $item->id, $text_key => $item->title . ' (' . $item->region->title . ')'];
            });
    }

    public static function toSelectArray($text_field = 'title', $value_field = 'id')
    {
        $fields = $text_field === $value_field ? [$text_field] : [$value_field, $text_field];
        $fields[] = 'region_id';
        $result = [];
        $query = self::query();
        $items = $query->with(['region'])->get($fields);
        foreach ($items as $item) {
            $result[$item->{$value_field}] = $item->title . ' (' . $item->region->title . ')';
        }
        return $result;
    }
}
