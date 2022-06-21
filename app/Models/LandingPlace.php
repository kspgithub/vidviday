<?php

namespace App\Models;

use App\Models\Traits\Scope\JsonLikeScope;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class LandingPlace extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;
    use HasTranslatableSlug;
    use JsonLikeScope;
    use UseSelectBox;
    use UsePublishedScope;

    public $translatable = [
        'title',
        'description',
        'slug',
    ];

    protected $fillable = [
        'title',
        'description',
        'slug',
        'published',
        'lat',
        'lng',
    ];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
        'published' => 'boolean',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Места посадки
     *
     * @return BelongsToMany
     */
    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tours_landings', 'landing_id', 'tour_id');
    }

    public function scopeAutocomplete(Builder $query, $search = '')
    {
        $search = strtolower(urldecode(trim($search)));
        $query = $query->published()
            ->whereRaw('LOWER(title->"$.uk") like ?', '%'.$search.'%')
            ->orWhereRaw('LOWER(title->"$.en") like ?', '%'.$search.'%')
            ->orWhere('title->en', 'LIKE', "%$search%")
            ->select([
                'id',
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


    public function asSelectBox(
        $value_key = 'id',
        $text_key = 'text'
    )
    {
        return [
            $value_key => $this->id,
            $text_key => $this->title,
        ];
    }

}
