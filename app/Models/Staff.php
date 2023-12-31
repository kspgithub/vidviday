<?php

namespace App\Models;

use App\Models\Traits\Attributes\UserAttributes;
use App\Models\Traits\HasAvatar;
use App\Models\Traits\Methods\HasJsonSlug;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseNormalizeMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Traits\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Staff extends TranslatableModel implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use HasTranslatableSlug;
    use SoftDeletes;
    use UsePublishedScope;
    use HasAvatar;
    use InteractsWithMedia;
    use UseNormalizeMedia;
    use UserAttributes;
    use HasJsonSlug;
    use Notifiable;

    public $translatable = [
        'first_name',
        'last_name',
        'position',
        'label',
        'text',
        'additional',
        'slug',
    ];

    protected $fillable = [
        'user_id',
        'type',
        'first_name',
        'last_name',
        'position',
        'label',
        'text',
        'video',
        'avatar',
        'email',
        'phone',
        'skype',
        'viber',
        'telegram',
        'whatsapp',
        'additional',
        'published',
        'bitrix_id',
        'slug',
    ];

    protected $appends = [
        'name',
        'avatar_url',
        'url',
    ];

    protected $hidden = [
        'pivot',
        'avatar',
        'created_at',
        'updated_at',
        'deleted_at',
        'bitrix_id',
    ];

    public function routeNotificationForTurboSMS()
    {
        return $this->phone;
    }

    public static function toSelectBox()
    {
        return self::query()->selectRaw("last_name, first_name, id")
            ->get()->map(function ($it) {
                return ['value' => $it->id, 'text' => $it->last_name . ' ' . $it->first_name . ' (' . $it->types->implode('title', ', ') . ')'];
            })->toArray();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('normal')
            ->width(840)
            ->height(480);

        $this->addMediaConversion('thumb')
            ->width(315)
            ->height(180);
    }


    public function getPhonesAttribute()
    {
        return collect(array_filter(explode(', ', $this->phone)));
    }

    /**
     * @return MorphMany
     */
    public function testimonials()
    {
        return $this->morphMany(Testimonial::class, 'model');
    }

    /**
     * @return MorphMany
     */
    public function relatedTestimonials()
    {
        return $this->morphMany(Testimonial::class, 'related');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsToMany
     */
    public function types()
    {
        return $this->belongsToMany(StaffType::class, 'staffs_types', 'staff_id', 'type_id');
    }

    /**
     * @return BelongsToMany
     */
    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tours_staff', 'staff_id', 'tour_id');
    }

    /**
     * @return HasMany
     */
    public function manageTours()
    {
        return $this->hasMany(Tour::class, 'manager_id');
    }

    /**
     * @return HasMany
     */
    public function vacansies()
    {
        return $this->hasMany(Vacancy::class);
    }


    public function scopeOnlyExcursionLeaders(Builder $query)
    {
        return $query->whereHas('types', function (Builder $q) {
            return $q->where('slug', 'excursion-leader');
        });
    }

    public function scopeOnlyTourManagers(Builder $query)
    {
        return $query->whereHas('types', function (Builder $q) {
            return $q->where('slug', 'tour-manager');
        });
    }

    public function asSelectBox()
    {
        return [
            'value' => $this->id,
            'text' => $this->last_name . ' ' . $this->first_name,
        ];
    }

    public function shortInfo()
    {
        return (object)[
            'id' => $this->id,
            'user_id' => $this->user_id,
            'url' => $this->url,
            'name' => $this->name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'avatar' => $this->avatar,
            'initials' => $this->initials,
            'avatar_url' => $this->avatar_url,
            'label' => $this->label
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['last_name', 'first_name'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug')
            ->preventOverwrite();
    }

    public function getUrlAttribute()
    {
        if ($this->types->where('slug', 'excursion-leader')->count() > 0) {
            $prefix = '/guide';
        } else {
            $prefix = '/office-worker';
        }
        return url(!empty($this->slug) ? url($prefix . '/' . $this->slug) : '');
    }

    public function getAllToursAttribute()
    {
        $tours = $this->tours;
        $manageTours = $this->manageTours;

        return $tours->merge($manageTours)->unique('id');
    }
}
