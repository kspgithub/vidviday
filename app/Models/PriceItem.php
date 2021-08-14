<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

/**
 * Class PriceItem
 *
 * @package App\Models
 * @mixin IdeHelperPriceItem
 */
class PriceItem extends Model
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;

    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'tour_id',
        'title',
        'limited',
        'places',
        'price',
        'currency',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
        'price' => 'float'
    ];

    /**
     * @return BelongsTo
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
