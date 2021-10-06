<?php

namespace App\Models;

use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class Country
 *
 * @package App\Models
 * @mixin IdeHelperCountry
 */
class Country extends TranslatableModel
{
    use HasFactory;
    use UseSelectBox;
    use HasTranslations;

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
        'iso'
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
}
