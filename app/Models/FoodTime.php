<?php

namespace App\Models;

use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class FoodTime extends TranslatableModel
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

    public function foodItems()
    {
        return $this->hasMany(Food::class, 'time_id');
    }

    /**
     * @return HasMany
     */
    public function foods()
    {
        return $this->hasMany(TourFood::class);
    }

    public function asSelectBox(
        $value_key = 'id',
        $text_key = 'text'
    ) {
        return [
            $value_key => $this->id,
            $text_key => $this->title,
        ];
    }
}
