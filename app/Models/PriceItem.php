<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class PriceItem extends TranslatableModel
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
        'limited' => 'boolean',
        'published' => 'boolean',
        'price' => 'integer'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'published',
    ];

    /**
     * @return BelongsTo
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
