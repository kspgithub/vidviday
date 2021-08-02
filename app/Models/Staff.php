<?php

namespace App\Models;

use App\Models\Traits\HasAvatar;
use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

/**
 * Class Staff
 *
 * @package App\Models
 * @mixin IdeHelperStaff
 */
class Staff extends Model
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
        'viber',
        'telegram',
        'whatsapp',
        'published',
    ];

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
    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'user_id');
    }

    public function vacansies()
    {
        return $this->hasMany(Vacancy::class);
    }


    public static function toSelectBox()
    {
        return  self::query()->selectRaw("CONCAT_WS(' ', last_name, first_name) as text, id as value")
            ->get()->map(function ($it) {
                return ['value'=>$it->value, 'text'=>$it->text];
            });
    }
}
