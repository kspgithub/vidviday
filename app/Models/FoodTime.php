<?php

namespace App\Models;

use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Class FoodTime
 *
 * @package App\Models
 * @mixin IdeHelperFoodTime
 */
class FoodTime extends Model
{
    use HasFactory;
    use HasTranslations;
    use UseSelectBox;

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
