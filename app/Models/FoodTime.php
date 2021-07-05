<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin IdeHelperFoodTime
 */
class FoodTime extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'title',
        'slug',
        'published',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function foods()
    {
        return $this->hasMany(TourFood::class);
    }
}
