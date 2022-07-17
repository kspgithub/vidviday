<?php

namespace App\Models\Traits\Scope;

use Illuminate\Database\Eloquent\Builder;
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
            return $q->whereDate('start_date', '>=', Carbon::now());
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
            'scheduleItems' => function ($sc) {
                return $sc->whereDate('start_date', '>=', Carbon::now());
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

        $query->join('tour_schedules', 'tours.id', '=', 'tour_schedules.tour_id')
            ->select('tours.*')
            ->addSelect(DB::raw('MIN(start_date) as nearest_date'))
            ->groupBy('id')
            ->whereJsonContains('locales', $locale)
            ->when(!empty($params['date_from']), function (Builder $q) use ($params) {
                return $q->whereHas('scheduleItems', function (Builder $sq) use ($params) {
                    return $sq->whereDate('start_date', '>=', Carbon::createFromFormat('d.m.Y', $params['date_from']));
                });
            })
            ->when(!empty($params['date_to']), function (Builder $q) use ($params) {
                return $q->whereHas('scheduleItems', function (Builder $sq) use ($params) {
                    return $sq->whereDate('end_date', '<=', Carbon::createFromFormat('d.m.Y', $params['date_from']));
                });
            })
            ->when(!empty($params['duration_from']), function (Builder $q) use ($params) {
                return $q->where('duration', '>=', $params['duration_from']);
            })
            ->when(!empty($params['duration_to']), function (Builder $q) use ($params) {
                return $q->where('duration', '<=', $params['duration_to']);
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
                    $sq->whereIn('tours_directions.id', $ids);
                });
            })
            ->when(!empty($params['type']), function (Builder $q) use ($params) {
                return $q->whereHas('types', function (Builder $sq) use ($params) {
                    $ids = array_filter(explode(',', $params['type']));
                    $sq->whereIn('tours_tour_types.id', $ids);
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
                return $q->jsonLike('tours.title', "%$search%");
            });

        $query->withAvg('testimonials', 'rating');

        $sort_by = !empty($params['sort_by']) ? $params['sort_by'] : 'created';
        $sort_dir = !empty($params['sort_dir']) && $params['sort_dir'] === 'desc' ? 'desc' : 'asc';

        if($sort_by === 'created') {
            $sort_by = 'nearest_date';
        }
        if($sort_by === 'rating') {
            $sort_by = 'testimonials_avg_rating';
        }

        return $query->orderBy($sort_by, $sort_dir);
    }
}
