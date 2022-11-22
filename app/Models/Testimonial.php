<?php

namespace App\Models;

use App\Models\Traits\HasAvatar;
use App\Models\Traits\UseNormalizeMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Testimonial extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use UseNormalizeMedia;
    use NodeTrait;
    use HasAvatar;

    public const STATUS_NEW = 0;
    public const STATUS_PUBLISHED = 1;
    public const STATUS_BLOCKED = 2;

    public const SHORT_TEXT_STR_LIMIT = 120;

    public const TYPES = [
        Tour::class => 'Тур',
        Staff::class => 'Персонал',
        Place::class => 'Місце',
    ];

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
        'status',
        'user_id',
        'rating',
        'avatar',
        'name',
        'phone',
        'email',
        'text',
        'attachments',
        'model_type',
        'model_id',
        'related_type',
        'related_id',
        'created_at',
    ];

    protected $appends = [
        'initials',
        'on_moderation',
        'avatar_url',
        'date',
        'time',
        'gallery',
        'tour',
        'place',
        'guide',
        'type',
        'short_text',
    ];

    protected $hidden = [
        'media',
        'model',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    /**
     * @return MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }

    /**
     * @return MorphTo
     */
    public function related()
    {
        return $this->morphTo();
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

    public function getTypeAttribute()
    {

        switch ($this->model_type) {
            case Tour::class:
                $type = 'tour';
                break;
            case Staff::class:
                $type = 'staff';
                break;
            case Place::class:
                $type = 'place';
                break;
            default:
                $type = 'other';
                break;
        }
        return $type;
    }

    public function getDateAttribute()
    {
        return $this->created_at?->format('d.m.Y');
    }

    public function getTimeAttribute()
    {
        return $this->created_at?->format('H:i');
    }

    public function getTourAttribute()
    {
        if ($this->model instanceof Tour) {
            return $this->model->shortInfo();
        }
        if ($this->related instanceof Tour) {
            return $this->related->shortInfo();
        }
        return null;
    }

    public function getPlaceAttribute()
    {
        return $this->model instanceof Place ? $this->model->shortInfo() : null;
    }

    public function getGuideAttribute()
    {
        if ($this->model instanceof Staff) {
            return $this->model->shortInfo();
        }
        if ($this->related instanceof Staff) {
            return $this->related->shortInfo();
        }
        return null;
    }

    public function getOnModerationAttribute()
    {
        return site_option('moderate_testimonials', false) === true && $this->status === 0;
    }

    public function getShortTextAttribute()
    {
        return str_limit(strip_tags(html_entity_decode($this->text)), self::SHORT_TEXT_STR_LIMIT);
    }

    public function scopeModerated(Builder $query)
    {
        return $query->where(function ($q) {
            $q->whereIn('status', site_option('moderate_testimonials', false) === true ? [1] : [0, 1]);
//            if (current_user() !== null) {
//                $q->orWhere('user_id', current_user()->id);
//            }
            return $q;
        });
    }

    public function scopeTourTestimonials(Builder $query)
    {
        return $query->where('model_type', Tour::class);
    }

    public function getGalleryAttribute()
    {
        return $this->getMedia()->map->toSwiperSlide();
    }
}
