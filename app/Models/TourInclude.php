<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class TourInclude extends Model
{
    use HasTranslations;
    use UsePublishedScope;

    public $translatable = [
        'text',
    ];

    protected $fillable = [
        'tour_id',
        'type_id',
        'finance_id',
        'text',
        'slug',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    /**
     * @return BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(IncludeType::class, 'type_id');
    }

    /**
     * @return BelongsTo
     */
    public function finance()
    {
        return $this->belongsTo(Finance::class, 'finance_id');
    }
}
