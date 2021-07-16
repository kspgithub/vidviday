<?php

namespace App\Models;

use App\Models\Traits\UseNormalizeMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class TourQuestion
 *
 * @package App\Models
 * @mixin IdeHelperTourQuestion
 */
class TourQuestion extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use UseNormalizeMedia;

    public const STATUS_NEW = 0;
    public const STATUS_PUBLISHED = 1;
    public const STATUS_BLOCKED = 2;

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('normal')
            ->width(840)
            ->height(480);

        $this->addMediaConversion('thumb')
            ->width(315)
            ->height(180);
    }

    protected $fillable = [
        'parent_id',
        'user_id',
        'tour_id',
        'status',
        'rating',
        'avatar',
        'name',
        'phone',
        'email',
        'text',
        'attachments',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(TourQuestion::class, 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(TourQuestion::class, 'parent_id');
    }
}
