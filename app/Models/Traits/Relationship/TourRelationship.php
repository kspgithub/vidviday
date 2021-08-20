<?php

namespace App\Models\Traits\Relationship;

use App\Models\Badge;
use App\Models\Direction;
use App\Models\Discount;
use App\Models\Place;
use App\Models\PriceItem;
use App\Models\Staff;
use App\Models\Testimonial;
use App\Models\TourAccommodation;
use App\Models\TourFood;
use App\Models\TourGroup;
use App\Models\TourInclude;
use App\Models\TourPlan;
use App\Models\TourQuestion;
use App\Models\TourSchedule;
use App\Models\TourSubject;
use App\Models\TourType;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait TourRelationship
{
    /**
     * Направления
     *
     * @return BelongsToMany
     */
    public function directions()
    {
        return $this->belongsToMany(Direction::class, 'tours_directions', 'tour_id', 'direction_id');
    }

    /**
     * Места
     *
     * @return BelongsToMany
     */
    public function places()
    {
        return $this->belongsToMany(Place::class, 'tours_places', 'tour_id', 'place_id')
            ->orderByPivot('position');
    }

    /**
     * Группы
     *
     * @return BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(TourGroup::class, 'tours_tour_groups', 'tour_id', 'group_id');
    }

    /**
     * Типы
     *
     * @return BelongsToMany
     */
    public function types()
    {
        return $this->belongsToMany(TourType::class, 'tours_tour_types', 'tour_id', 'type_id');
    }

    /**
     * Тематика
     *
     * @return BelongsToMany
     */
    public function subjects()
    {
        return $this->belongsToMany(TourSubject::class, 'tours_subjects', 'tour_id', 'subject_id');
    }

    /**
     * План
     *
     * @return HasMany
     */
    public function planItems()
    {
        return $this->hasMany(TourPlan::class);
    }

    /**
     * Расписание
     *
     * @return HasMany
     */
    public function scheduleItems()
    {
        return $this->hasMany(TourSchedule::class);
    }

    /**
     * Финансы (Тур включает в себя, либо приобретается отдельно)
     *
     * @return HasMany
     */
    public function tourIncludes()
    {
        return $this->hasMany(TourInclude::class);
    }

    /**
     * Питание
     *
     * @return HasMany
     */
    public function foodItems()
    {
        return $this->hasMany(TourFood::class);
    }

    /**
     * Размещение
     *
     * @return HasMany
     */
    public function accommodations()
    {
        return $this->hasMany(TourAccommodation::class);
    }

    /**
     * Доп фишки которые можно купить, используются также в калькуляторе
     *
     * @return HasMany
     */
    public function priceItems()
    {
        return $this->hasMany(PriceItem::class);
    }

    /**
     * Отзывы к туру
     *
     * @return MorphMany
     */
    public function testimonials()
    {
        return $this->morphMany(Testimonial::class, 'model');
    }

    /**
     * Отзывы в которых упоминается тур, например в отзывах к местам, сотрудникам
     *
     * @return MorphMany
     */
    public function relatedTestimonials()
    {
        return $this->morphMany(Testimonial::class, 'related');
    }

    /**
     * Вопросы к туру
     *
     * @return HasMany
     */
    public function questions()
    {
        return $this->hasMany(TourQuestion::class);
    }

    /**
     * Менеджеры тура
     *
     * @return BelongsToMany
     */
    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'tours_staff');
    }

    /**
     * Бейджи
     *
     * @return BelongsToMany
     */
    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'tour_badges');
    }

    /**
     * Get all of the tour's discounts.
     *
     * @return MorphMany
     */
    public function discounts()
    {

        return $this->morphMany(Discount::class, 'model_nameable');
    }
}
