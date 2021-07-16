<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class TourSchedule
 *
 * @package App\Models
 * @mixin IdeHelperTourSchedule
 */
class TourSchedule extends Model
{
    use HasFactory;
    use UsePublishedScope;

    protected $fillable = [
        'tour_id',
        'start_date',
        'end_date',
        'places',
        'price',
        'commission',
        'currency',
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
