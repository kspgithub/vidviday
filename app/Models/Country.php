<?php

namespace App\Models;

use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Class Country
 *
 * @package App\Models
 * @mixin IdeHelperCountry
 */
class Country extends Model
{
    use HasFactory;
    use HasTranslations;
    use UseSelectBox;

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

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
