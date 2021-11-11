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
        $query = $query->published()->with([
            'media' => function ($sc) {
                return $sc->whereIn('collection_name', ['main', 'mobile']);
            },
        ])->where(function ($q) use ($search) {
            $search = urldecode(trim($search));
            return $q->where('title->uk', 'LIKE', "%$search%")
                ->orWhere('title->ru', 'LIKE', "%$search%")
                ->orWhere('title->en', 'LIKE', "%$search%")
                ->orWhere('title->pl', 'LIKE', "%$search%");
        })
            ->select([
                'id',
                'title',
                'price',
                'commission',
                'currency',
                'rating',
                'duration',
                'nights',
                'slug',
            ]);

        if (!empty($search)) {
            $query->addSelect(DB::raw("LOCATE('$search', title) as relevant"))
                ->orderBy('relevant');
        } else {
            $query->orderBy('title');
        }

        return $query;
    }

    public function scopeSearch(Builder $query)
    {
        return $query->inFuture()->published()->with([
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
        $query
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
                return $q->where('price', '>=', $params['price_from']);
            })
            ->when(!empty($params['price_to']), function (Builder $q) use ($params) {
                return $q->where('price', '<=', $params['price_to']);
            })
            ->when(!empty($params['direction']), function (Builder $q) use ($params) {
                return $q->whereHas('directions', function (Builder $sq) use ($params) {
                    $ids = array_filter(explode(',', $params['direction']));
                    $sq->whereIn('id', $ids);
                });
            })
            ->when(!empty($params['type']), function (Builder $q) use ($params) {
                return $q->whereHas('types', function (Builder $sq) use ($params) {
                    $ids = array_filter(explode(',', $params['type']));
                    $sq->whereIn('id', $ids);
                });
            })
            ->when(!empty($params['subject']), function (Builder $q) use ($params) {
                return $q->whereHas('subjects', function (Builder $sq) use ($params) {
                    $ids = array_filter(explode(',', $params['subject']));
                    $sq->whereIn('id', $ids);
                });
            })
            ->when(!empty($params['q']), function (Builder $q) use ($params) {
                $search = urldecode(trim($params['q']));
                return $q->where('title->uk', 'LIKE', "%$search%")
                    ->orWhere('title->ru', 'LIKE', "%$search%")
                    ->orWhere('title->en', 'LIKE', "%$search%")
                    ->orWhere('title->pl', 'LIKE', "%$search%");
            });

        $sort_by = !empty($params['sort_by']) && $params['sort_by'] === 'crated' ? 'created_at' : 'price';
        $sort_dir = !empty($params['sort_dir']) && $params['sort_dir'] === 'desc' ? 'desc' : 'asc';

        return $query->orderBy($sort_by, $sort_dir);
    }
}
