<?php

namespace App\Models\Traits\Scope;

use App\Models\Order;
use App\Models\TourVoting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

trait TourScope
{
    /**
     * Будущие туры
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeInFuture(Builder $query)
    {
        return $query->whereHas('scheduleItems', function (Builder $q) {
            return $q
                ->where(function ($query) {
                    $query->whereDate('tour_schedules.start_date', '>=', now())
                        ->where(function ($query) {
                            $query->whereTime('tour_schedules.start_time', '>', now())
                                ->orWhereDate('tour_schedules.start_date', '>', now());
                        });
                })
                ->whereNull('tour_schedules.deleted_at');
        });
    }

    /**
     * Туры без расписания
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeUnavailable(Builder $query)
    {
        return $query->whereDoesntHave('scheduleItems', function (Builder $q) {
            return $q
                ->whereDate('tour_schedules.start_date', '>=', now())
                ->whereNull('tour_schedules.deleted_at');
        });
    }


    public function scopeAutocomplete(Builder $query, $search = '')
    {
        return $query->published()->jsonAutocomplete($search, [
            'id',
            'title',
            'price',
            'commission',
            'accomm_price',
            'currency',
            'rating',
            'duration',
            'nights',
            'slug',
            'corporate_includes'
        ], [
            'media' => function ($sc) {
                return $sc->whereIn('collection_name', ['main', 'mobile']);
            },
        ]);
    }

    public function scopeSearch(Builder $query, $params = [])
    {
        if (($params['future'] ?? false) == 1) {
            $query->inFuture();
        }

        $query->published()->with([
            'scheduleItems' => function (HasMany $q) use($params) {
                if(!empty($params['date_from']) ){
                    $dateFrom = Carbon::createFromFormat('d.m.Y', $params['date_from']); 
                } else{
                    $dateFrom = now();
                    $timeFrom = now();
                } 
                $dateTo = !empty($params['date_to']) ? Carbon::createFromFormat('d.m.Y', $params['date_to']) : null;

                return $q
                    ->with('orders')
                    ->whereDate('tour_schedules.start_date', '>=', $dateFrom)
                    ->when($timeFrom, function (Builder $q) use ($timeFrom,$dateFrom) {
                        return $q->whereTime('tour_schedules.start_time', '>', $timeFrom)
                                ->orWhereDate('tour_schedules.start_date', '>', $dateFrom);
                    })
                    ->when($dateTo, function (Builder $q) use ($dateTo) {
                        return $q->whereDate('tour_schedules.start_date', '<=', $dateTo);
                    })
                    ->where('tour_schedules.published', 1)
                    ->whereNull('tour_schedules.deleted_at');
            },
            'media' => function ($q) {
                return $q->whereIn('collection_name', ['main', 'mobile']);
            },
            'badges',
        ]);

        $query->withCount(['testimonials' => function ($q) {
            return $q->moderated()
                ->orderBy('rating', 'desc')
                ->latest();
        }]);

        return $query;
    }


    public function scopeFilter(Builder $query, $params = [])
    {
        $locale = $params['lang'] ?? app()->getLocale();

        $order = [];
        $selects = [];

        $query
            ->whereJsonContains('locales', $locale)
            ->when(!empty($params['group_id']), function (Builder $q) use ($params) {
                return $q->whereHas('groups', function (Builder $gq) use ($params) {
                    return $gq->where('tour_groups.id', $params['group_id']);
                });
            })
            ->when(!empty($params['date_from']), function (Builder $q) use ($params) {
                return $q->whereHas('scheduleItems', function (Builder $sq) use ($params) {
                    return $sq->whereDate('tour_schedules.start_date', '>=', Carbon::createFromFormat('d.m.Y', $params['date_from']));
                });
            })
            ->when(!empty($params['date_to']), function (Builder $q) use ($params) {
                return $q->whereHas('scheduleItems', function (Builder $sq) use ($params) {
                    return $sq->whereDate('tour_schedules.start_date', '<=', Carbon::createFromFormat('d.m.Y', $params['date_to']));
                });
            })
            ->when(!empty($params['duration_from']), function (Builder $q) use ($params) {
                return $q->where('tours.duration', '>=', $params['duration_from']);
            })
            ->when(!empty($params['duration_to']), function (Builder $q) use ($params) {
                return $q->where('tours.duration', '<=', $params['duration_to']);
            })
            ->when(!empty($params['price_from']) || !empty($params['price_to']), function (Builder $q) use ($params, &$selects) {
                return $q->leftJoin('currencies', function (JoinClause $join) {
                    $join->on('tours.currency', '=', 'currencies.iso');
                });
            })
            ->when(!empty($params['price_from']), function (Builder $q) use ($params) {
                $currency = session('currency', 'UAH');
                $value = currency_value($params['price_from'], $currency);
                $course = currency_course();
                return $q->whereRaw('( (tours.price / currencies.course) / ' . $course . ' ) >= "' . $value . '"');
            })
            ->when(!empty($params['price_to']), function (Builder $q) use ($params) {
                $currency = session('currency', 'UAH');
                $value = currency_value($params['price_to'], $currency);
                $course = currency_course();
                return $q->whereRaw('( (tours.price / currencies.course) / ' . $course . ' ) <= "' . $value . '"');
            })
            ->when(!empty($params['direction']), function (Builder $q) use ($params) {
                return $q->inFuture()->whereHas('directions', function (Builder $sq) use ($params) {
                    $ids = array_filter(explode(',', $params['direction']));
                    $sq->whereIn('directions.id', $ids);
                });
            })
            ->when(!empty($params['type']), function (Builder $q) use ($params) {
                return $q->whereHas('types', function (Builder $sq) use ($params) {
                    $ids = array_filter(explode(',', $params['type']));
                    $sq->whereIn('tour_types.id', $ids);
                });
            })
            ->when(!empty($params['subject']), function (Builder $q) use ($params) {
                return $q->whereHas('subjects', function (Builder $sq) use ($params) {
                    $ids = array_filter(explode(',', $params['subject']));
                    $sq->whereIn('tour_subjects.id', $ids);
                });
            })
            ->when(!empty($params['place']), function (Builder $q) use ($params) {
                return $q->whereHas('places', function (Builder $sq) use ($params) {
                    $ids = array_filter(explode(',', $params['place']));
                    $sq->whereIn('places.id', $ids);
                })->orWhereHas('tourPlaces', function (Builder $sq) use ($params) {
                    $ids = array_filter(explode(',', $params['place']));
                    $sq->whereIn('tours_places.place_id', $ids);
                });
            })
            ->when(!empty($params['landing']), function (Builder $q) use ($params) {
                return $q->whereHas('landings', function (Builder $sq) use ($params) {
                    $ids = array_filter(explode(',', $params['landing']));
                    $sq->whereIn('landing_places.id', $ids);
                })->orWhereHas('tourLandings', function (Builder $sq) use ($params) {
                    $ids = array_filter(explode(',', $params['landing']));
                    $sq->whereIn('tours_landings.landing_id', $ids);
                });
            })
            ->when(!empty($params['q']), function (Builder $q) use ($params) {
                $search = urldecode(trim($params['q']));

                if ($search) {
                    $q->where(function (Builder $q) use ($search) {
                        // Search in Tours
                        $q->jsonLike('tours.title', "%$search%")
                            ->orJsonLike('tours.text', "%$search%")
                            ->orJsonLike('tours.short_text', "%$search%");
                    })->orWhere(function (Builder $q) use ($search) {
                        // Search in Tour Plans
                        $q->whereHas('planItems', function (Builder $q) use ($search) {
                            $q->jsonLike('tour_plans.title', "%$search%")
                                ->orJsonLike('tour_plans.text', "%$search%");
                        });
                    })->orWhere(function (Builder $q) use ($search) {
                        // Search in Tour Places
                        $q->whereHas('places', function (Builder $q) use ($search) {
                            $q->jsonLike('places.title', "%$search%")
                                ->orJsonLike('places.text', "%$search%");
                        });
                    })->orWhere(function (Builder $q) use ($search) {
                        // Search in Custom Tour Places
                        $q->whereHas('tourPlaces', function (Builder $q) use ($search) {
                            $q->jsonLike('tours_places.title', "%$search%")
                                ->orJsonLike('tours_places.text', "%$search%");
                        });
                    })->orWhere(function (Builder $q) use ($search) {
                        // Search in Tour Tickets
                        $q->whereHas('tickets', function (Builder $q) use ($search) {
                            $q->jsonLike('tickets.title', "%$search%")
                                ->orJsonLike('tickets.text', "%$search%");
                        });
                    })->orWhere(function (Builder $q) use ($search) {
                        // Search in Custom Tour Tickets
                        $q->whereHas('tourTickets', function (Builder $q) use ($search) {
                            $q->jsonLike('tours_tickets.title', "%$search%")
                                ->orJsonLike('tours_tickets.text', "%$search%");
                        });
                    })->orWhere(function (Builder $q) use ($search) {
                        // Search in Tour Food
                        $q->whereHas('foods', function (Builder $q) use ($search) {
                            $q->jsonLike('food.title', "%$search%")
                                ->orJsonLike('food.text', "%$search%");
                        });
                    })->orWhere(function (Builder $q) use ($search) {
                        // Search in Custom Tour Food
                        $q->whereHas('foodItems', function (Builder $q) use ($search) {
                            $q->jsonLike('tour_food.title', "%$search%")
                                ->orJsonLike('tour_food.text', "%$search%");
                        });
                    })->orWhere(function (Builder $q) use ($search) {
                        // Search in Tour Accommodations
                        $q->whereHas('accommodations', function (Builder $q) use ($search) {
                            $q->jsonLike('accommodations.title', "%$search%")
                                ->orJsonLike('accommodations.text', "%$search%");
                        });
                    })->orWhere(function (Builder $q) use ($search) {
                        // Search in Custom Tour Accommodations
                        $q->whereHas('tourAccommodations', function (Builder $q) use ($search) {
                            $q->jsonLike('tour_accommodations.title', "%$search%")
                                ->orJsonLike('tour_accommodations.text', "%$search%");
                        });
                    });
                }
            });

        $sort_by = !empty($params['sort_by']) ? $params['sort_by'] : 'date';
        $sort_dir = !empty($params['sort_dir']) && $params['sort_dir'] === 'desc' ? 'desc' : 'asc';

        if ($sort_by === 'date') {
            $query->orderByDate();
        }

        if ($sort_by === 'created') {
            $order[] = ['by' => 'created_at'];
        }
        if ($sort_by === 'rating') {
            $order[] = ['by' => 'testimonials_avg_rating'];
        }
        if ($sort_by === 'popular') {
            $query->withCount('views');

            $order[] = ['by' => 'views_count'];
        }
        if ($sort_by === 'duration') {
            $query->addSelect(DB::raw('((IFNULL(tours.duration, 0) * 16) + (IFNULL(tours.nights, 0) * 8) + IFNULL(tours.time, 0)) as duration_hours'));

            $order[] = ['by' => 'duration_hours'];
        }

        foreach ($order as $item) {
            $query->orderBy($item['by'] ?? $sort_by, $item['dir'] ?? $sort_dir);
        }

        foreach ($selects as $key => $value) {
            $query->addSelect($value);
        }

        // With
        $query->withAvg(['testimonials' => function ($q) {
            return $q->moderated()
                ->orderBy('rating', 'desc')
                ->latest();
        }], 'rating');

        return $query;
    }

    public function scopeOrderByDate(Builder $query)
    {
        $query->leftJoin('tour_schedules', function (JoinClause $join) {
            $join->on('tours.id', '=', 'tour_schedules.tour_id')
                ->where('tour_schedules.published', 1)
                ->where('tour_schedules.start_date', '>=', now())
                ->whereNull('tour_schedules.deleted_at');
        });

        $query->leftJoin('tour_votings', function (JoinClause $join) {
            $join->on('tours.id', '=', 'tour_votings.tour_id')
                ->where('tour_votings.status', '=', TourVoting::STATUS_PUBLISHED);
        });

        $query->leftJoin('tour_views', function (JoinClause $join) {
            $join->on('tours.id', '=', 'tour_views.tour_id');
        });

        $query->select('tours.*')
//            ->addSelect(DB::raw('COUNT(tour_votings.tour_id) as votings_count'))
//            ->addSelect(DB::raw('COUNT(tour_views.tour_id) as views_count'))
            ->addSelect(DB::raw(
                '
                    CASE WHEN MIN(tour_schedules.start_date) IS NULL
                        THEN (
                            CASE WHEN COUNT(tour_votings.tour_id) > 0
                                THEN SUBDATE("2111-01-01", INTERVAL COUNT(tour_votings.tour_id) DAY)
                                ELSE SUBDATE("2222-01-01", INTERVAL COUNT(tour_views.tour_id) DAY)
                            END
                        )
                        ELSE MIN(tour_schedules.start_date)
                    END as date'
            ))
            ->addSelect(DB::raw(
                '
                    CASE WHEN MIN(tour_schedules.start_date) IS NULL
                        THEN (SELECT MAX(tours.priority) FROM tours)+1
                        ELSE (
                            CASE WHEN tours.priority IS NULL
                                THEN (SELECT MAX(tours.priority) FROM tours)+1
                                ELSE tours.priority
                            END
                        )
                    END as sort_order'
            ));
        $query->groupBy('tours.id');
        $query->orderBy('date');
        $query->orderBy('sort_order', 'desc');
    }
}
