<?php

namespace App\Models;

use App\Models\Traits\UseNormalizeMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TourQuestion extends Model implements HasMedia
{
    use InteractsWithMedia;
    use UseNormalizeMedia;
    use NodeTrait;

    public const STATUS_NEW = 0;
    public const STATUS_PUBLISHED = 1;
    public const STATUS_BLOCKED = 2;

    public const SHORT_TEXT_STR_LIMIT = 120;

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
        'created_at',
    ];


    protected $appends = [
        'initials',
        'avatar_url',
        'gallery',
        'short_text',
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
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function getInitialsAttribute()
    {
        $name_parts = explode(' ', $this->name);
        $initials = '';
        if (count($name_parts) > 0) {
            $initials .= Str::upper(Str::substr($name_parts[0], 0, 1));
        }
        if (count($name_parts) > 1) {
            $initials .= Str::upper(Str::substr($name_parts[1], 0, 1));
        }
        return !empty($initials) ? $initials : 'N/A';
    }

    /**
     * @return string
     */
    public function getAvatarUrlAttribute(): string
    {
        $avatar = $this->getAttributeValue('avatar');

        return !empty($avatar) ? Storage::url($avatar) : asset('/icon/login.svg');
    }

    public function getOnModerationAttribute()
    {
        return site_option('moderate_questions', false) === true && $this->status === 0;
    }

    public function getShortTextAttribute()
    {
        return str_limit(strip_tags(html_entity_decode($this->text)), self::SHORT_TEXT_STR_LIMIT);
    }

    public function getGalleryAttribute()
    {
        return $this->getMedia()->map->toSwiperSlide();
    }

    public function scopeModerated(Builder $query)
    {
        return $query->withDepth()->where(function ($q) {
            $q->whereIn('status', site_option('moderate_questions', false) === true ? [1] : [0, 1]);
            if (current_user() !== null) {
                $q->orWhere('user_id', current_user()->id);
            }
            return $q;
        });
    }
}
