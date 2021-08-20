<?php

namespace App\Models;

use App\Models\Traits\HasAvatar;
use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

/**
 * Class Staff
 *
 * @package App\Models
 * @mixin IdeHelperStaff
 */
class Staff extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;
    use UsePublishedScope;
    use HasAvatar;

    public $translatable = [
        'first_name',
        'last_name',
        'position',
        'text',
    ];

    protected $fillable = [
        'user_id',
        'type',
        'first_name',
        'last_name',
        'position',
        'text',
        'avatar',
        'email',
        'phone',
        'skype',
        'viber',
        'telegram',
        'whatsapp',
        'published',
    ];

    public static function toSelectBox()
    {
        return self::query()->selectRaw("CONCAT_WS(' ', last_name, first_name) as text, id as value")
            ->get()->map(function ($it) {
                return ['value' => $it->value, 'text' => $it->text];
            });
    }

    /**
     * @return MorphMany
     */
    public function testimonials()
    {
        return $this->morphMany(Testimonial::class, 'model');
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
}
