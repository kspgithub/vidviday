<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

/**
 * Class TourPlan
 *
 * @package App\Models
 * @mixin IdeHelperTourPlan
 */
class TourPlan extends Model
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;

    public $translatable = [
        'title',
        'text',
    ];

    protected $fillable = [
        'title',
        'text',
        'slug',
        'lat',
        'lng',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean'
    ];

    /**
     * @return BelongsTo
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
