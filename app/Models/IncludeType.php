<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin IdeHelperIncludeType
 */
class IncludeType extends Model
{
    use HasTranslations;

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
    public function tour_includes()
    {
        return $this->hasMany(TourInclude::class);
    }
}
