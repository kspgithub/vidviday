<?php

namespace App\Models;

use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

/**
 * Class IncludeType
 *
 * @package App\Models
 * @mixin IdeHelperIncludeType
 */
class IncludeType extends Model
{
    use HasTranslations;
    use UseSelectBox;

    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'title',
        'slug',
    ];

    /**
     * @return HasMany
     */
    public function tourIncludes()
    {
        return $this->hasMany(TourInclude::class);
    }
}
