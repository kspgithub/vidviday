<?php

namespace App\Models;

use App\Models\Traits\Scope\JsonLikeScope;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traits\HasSlug;
use Spatie\Translatable\HasTranslations;

class Country extends TranslatableModel
{
    use HasFactory;
    use UseSelectBox;
    use HasTranslations;
    use JsonLikeScope;

    public const DEFAULT_COUNTRY_ID = 1;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'title',
        'slug',
        'iso',
        'phone_code',
        'phone_mask',
        'phone_rule',
    ];

    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
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
