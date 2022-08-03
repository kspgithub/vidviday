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
            return $q->whereDate('tour_schedules.start_date', '>=', Carbon::now());
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

    public function scopeSearch(Builder $query, $onlyFuture = true)
    {
        if ($onlyFuture) {
            $query->inFuture();
        }
        return $query->published()->with([
            'scheduleItems' => function (HasMany $sc) {
                $sc->with(['orders']);
                return $sc->whereDate('tour_schedules.start_date', '>=', Carbon::now());
            },
            'media' => function ($sc) {
                return $sc->whereIn('collection_name', ['main', 'mobile']);
            },
            'badges'
        ])
            ->withCount(['testimonials']);
    }


    public function scopeFilter(Builder $query, $params)
    {
        $locale = $params['lang'] ?? 'uk';

        $query
            ->whereJsonContains('locales', $locale)
            ->when(!empty($params['date_from']), function (Builder $q) use ($params) {
                return $q->whereHas('scheduleItems', function (Builder $sq) use ($params) {
                    return $sq->whereDate('tour_schedules.start_date', '>=', Carbon::createFromFormat('d.m.Y', $params['date_from']));
                });
            })
            ->when(!empty($params['date_to']), function (Builder $q) use ($params) {
                return $q->whereHas('scheduleItems', function (Builder $sq) use ($params) {
                    return $sq->whereDate('tour_schedules.end_date', '<=', Carbon::createFromFormat('d.m.Y', $params['date_to']));
                });
            })
            ->when(!empty($params['duration_from']), function (Builder $q) use ($params) {
                return $q->where('tours.duration', '>=', $params['duration_from']);
            })
            ->when(!empty($params['duration_to']), function (Builder $q) use ($params) {
                return $q->where('tours.duration', '<=', $params['duration_to']);
            })
            ->when(!empty($params['price_from']), function (Builder $q) use ($params) {
                return $q->where('tours.price', '>=', $params['price_from']);
            })
            ->when(!empty($params['price_to']), function (Builder $q) use ($params) {
                return $q->where('tours.price', '<=', $params['price_to']);
            })
            ->when(!empty($params['direction']), function (Builder $q) use ($params) {
                return $q->whereHas('directions', function (Builder $sq) use ($params) {
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
                    $sq->whereIn('tours_places.id', $ids);
                });
            })
            ->when(!empty($params['landing']), function (Builder $q) use ($params) {
                return $q->whereHas('landings', function (Builder $sq) use ($params) {
                    $ids = array_filter(explode(',', $params['landing']));
                    $sq->whereIn('landing_places.id', $ids);
                })->orWhereHas('tourLandings', function (Builder $sq) use ($params) {
                    $ids = array_filter(explode(',', $params['landing']));
                    $sq->whereIn('tours_landings.id', $ids);
                });
            })
            ->when(!empty($params['q']), function (Builder $q) use ($params) {
                $search = urldecode(trim($params['q']));

                if ($search) {
                    $q->where(function (Builder $q) use ($search) {
                        // Search in Tours
                        $q->jsonLike('tours.title', "%$search%");
                    })->orWhere(function (Builder $q) use ($search) {
                        // Search in Tour Plans
                        $q->whereHas('planItems', function (Builder $q) use ($search) {
                            $q->jsonLike('tour_plans.title', "%$search%");
                        });
                    })->orWhere(function (Builder $q) use ($search) {
                        // Search in Tour Places
                        $q->whereHas('places', function (Builder $q) use ($search) {
                            $q->jsonLike('places.title', "%$search%");
                        });
                    })->orWhere(function (Builder $q) use ($search) {
                        // Search in Custom Tour Places
                        $q->whereHas('tourPlaces', function (Builder $q) use ($search) {
                            $q->jsonLike('tours_places.title', "%$search%");
                        });
                    })->orWhere(function (Builder $q) use ($search) {
                        // Search in Tour Tickets
                        $q->whereHas('tickets', function (Builder $q) use ($search) {
                            $q->jsonLike('tickets.title', "%$search%");
                        });
                    })->orWhere(function (Builder $q) use ($search) {
                        // Search in Custom Tour Tickets
                        $q->whereHas('tourTickets', function (Builder $q) use ($search) {
                            $q->jsonLike('tours_tickets.title', "%$search%");
                        });
                    })->orWhere(function (Builder $q) use ($search) {
                        // Search in Tour Food
                        $q->whereHas('foods', function (Builder $q) use ($search) {
                            $q->jsonLike('food.title', "%$search%");
                        });
                    })->orWhere(function (Builder $q) use ($search) {
                        // Search in Custom Tour Food
                        $q->whereHas('foodItems', function (Builder $q) use ($search) {
                            $q->jsonLike('tour_food.title', "%$search%");
                        });
                    })->orWhere(function (Builder $q) use ($search) {
                        // Search in Tour Accommodations
                        $q->whereHas('accommodations', function (Builder $q) use ($search) {
                            $q->jsonLike('accommodations.title', "%$search%");
                        });
                    })->orWhere(function (Builder $q) use ($search) {
                        // Search in Custom Tour Accommodations
                        $q->whereHas('tourAccommodations', function (Builder $q) use ($search) {
                            $q->jsonLike('tour_accommodations.title', "%$search%");
                        });
                    });
                }
            });

        $query->withAvg('testimonials', 'rating');

        $sort_by = !empty($params['sort_by']) ? $params['sort_by'] : 'date';
        $sort_dir = !empty($params['sort_dir']) && $params['sort_dir'] === 'desc' ? 'desc' : 'asc';

        if($sort_by === 'date') {
            $query->leftJoin('tour_schedules', function (JoinClause $join) {
                    $join->on( 'tours.id', '=', 'tour_schedules.tour_id')
                        ->where('tour_schedules.start_date', '>=', now())
                        ->whereNull('tour_schedules.deleted_at')
                    ;
                })
                ->leftJoin('tour_votings', function (JoinClause $join) {
                    $join->on( 'tours.id', '=', 'tour_votings.tour_id')
                        ->where('tour_votings.status', '=', TourVoting::STATUS_PUBLISHED);
                })
                ->select('tours.*')
                ->addSelect(DB::raw('COUNT(tour_votings.id) as votings_count'))
                ->addSelect(DB::raw('CASE WHEN MIN(tour_schedules.start_date) IS NULL THEN SUBDATE("2099-01-01", INTERVAL COUNT(tour_votings.id) DAY) ELSE MIN(tour_schedules.start_date) END as date'))
                ->groupBy('tours.id');
        }
        if($sort_by === 'created') {
            $sort_by = 'created_at';
        }
        if($sort_by === 'rating') {
            $sort_by = 'testimonials_avg_rating';
        }
        if($sort_by === 'popular') {
            $query->withCount('views');
            $sort_by = 'views_count';
        }
        if($sort_by === 'duration') {
            $query->addSelect(DB::raw('((IFNULL(tours.duration, 0) * 16) + (IFNULL(tours.nights, 0) * 8) + IFNULL(tours.time, 0)) as duration_hours'));
            $sort_by = 'duration_hours';
        }

        return $query->orderBy($sort_by, $sort_dir);
    }
}
