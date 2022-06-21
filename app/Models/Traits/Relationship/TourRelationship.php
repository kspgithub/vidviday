<?php

namespace App\Models\Traits\Relationship;

use App\Models\Badge;
use App\Models\Currency;
use App\Models\Direction;
use App\Models\Discount;
use App\Models\LandingPlace;
use App\Models\Order;
use App\Models\Place;
use App\Models\PriceItem;
use App\Models\Staff;
use App\Models\Testimonial;
use App\Models\Ticket;
use App\Models\Tour;
use App\Models\TourAccommodation;
use App\Models\TourDiscount;
use App\Models\TourFaq;
use App\Models\TourFood;
use App\Models\TourGroup;
use App\Models\TourInclude;
use App\Models\TourLanding;
use App\Models\TourPlace;
use App\Models\TourPlan;
use App\Models\TourQuestion;
use App\Models\TourSchedule;
use App\Models\TourSubject;
use App\Models\TourTicket;
use App\Models\TourTransport;
use App\Models\TourType;
use App\Models\Transport;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    public function tourPlaces()
    {
        return $this->hasMany(TourPlace::class)->orderBy('position');
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
        return $this->hasMany(TourFood::class)->orderBy('day')->orderBy('time_id');
    }

    /**
     * Размещение
     *
     * @return HasMany
     */
    public function accommodations()
    {
        return $this->hasMany(TourAccommodation::class)->orderBy('position');
    }
    public function tourAccommodations()
    {
        return $this->hasMany(TourAccommodation::class)->orderBy('position');
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
        return $this->morphMany(Testimonial::class, 'model')->withDepth()->reversed();
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
        return $this->hasMany(TourQuestion::class)->withDepth()->reversed();
    }

    /**
     * Сотрудники тура
     *
     * @return BelongsToMany
     */
    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'tours_staff');
    }

    /**
     * Гиды тура
     *
     * @return BelongsToMany
     */
    public function guides()
    {
        return $this->staff()->whereHas('types', function ($q) {
            return $q->where('slug', 'excursion-leader');
        });
    }

    /**
     * Менеджер тура
     * @return BelongsTo
     */
    public function manager()
    {
        return $this->belongsTo(Staff::class, 'manager_id');
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
     * Discounts
     *
     * @return BelongsToMany
     */
    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'tours_discounts', 'tour_id', 'discount_id')
            ->orderByPivot('position');
    }
    public function tourDiscounts()
    {
        return $this->hasMany(TourDiscount::class)->orderBy('tours_discounts.position');
    }

    /**
     * Входные билеты
     *
     * @return BelongsToMany
     */
    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'tours_tickets', 'tour_id', 'ticket_id');
    }
    public function tourTickets()
    {
        return $this->hasMany(TourTicket::class)->orderBy('position');
    }

    /**
     * Вопросы к туру
     *
     * @return HasMany
     */
    public function faq()
    {
        return $this->hasMany(TourFaq::class, 'tour_id');
    }

    /**
     * Места посадки
     *
     * @return BelongsToMany
     */
    public function landings()
    {
        return $this->belongsToMany(LandingPlace::class, 'tours_landings', 'tour_id', 'landing_id')
            ->orderByPivot('position');
    }

    /**
     * Места посадки
     *
     * @return HasMany
     */
    public function tourLandings()
    {
        return $this->hasMany(TourLanding::class)->orderBy('position');
    }

    /**
     * Замовлення
     *
     * @return HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function transports()
    {
        return $this->belongsToMany(Transport::class, 'tour_transports', 'tour_id', 'transport_id')
            ->orderByPivot('position');
    }

    public function tourTransports()
    {
        return $this->hasMany(TourTransport::class)->orderBy('position');
    }

    public function currencyModel()
    {
        return $this->belongsTo(Currency::class, 'currency', 'iso');
    }
}
