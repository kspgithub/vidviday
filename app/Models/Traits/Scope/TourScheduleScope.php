<?php

namespace App\Models\Traits\Scope;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

trait TourScheduleScope
{
    public function scopeInFuture(Builder $query)
    {
        return $query->published()->whereDate('start_date', '>=', Carbon::now()->addDays(1))->orderBy('start_date');
    }

    public function scopeBetween(Builder $query, $start, $end)
    {
        return $query->where(function ($sq) use ($start, $end) {
            $sq->where(function ($q) use ($start, $end) {
                return $q->whereDate('start_date', '>=', $start->toDateString())
                    ->whereDate('start_date', '<=', $end->toDateString());
            })
                ->orWhere(function ($q) use ($start, $end) {
                    return $q->whereDate('end_date', '>=', $start->toDateString())
                        ->whereDate('end_date', '<=', $end->toDateString());
                })
                ->orWhere(function ($q) use ($start, $end) {
                    return $q->whereDate('start_date', '<', $start->toDateString())
                        ->whereDate('end_date', '>', $end->toDateString());
                });
        });
    }

    public function scopeFilter(Builder $query, $params = [])
    {
        $query
            ->when(! empty($params['date_from']), function (Builder $q) use ($params) {
                return $q->whereDate('start_date', '>=', Carbon::createFromFormat('d.m.Y', $params['date_from']));
            })
            ->when(! empty($params['date_to']), function (Builder $q) use ($params) {
                return $q->whereDate('end_date', '<=', Carbon::createFromFormat('d.m.Y', $params['date_from']));
            })
            ->when(! empty($params['duration_from']), function (Builder $q) use ($params) {
                return $q->whereHas('tour', function ($sq) use ($params) {
                    return $sq->where('duration', '>=', $params['duration_from']);
                });
            })
            ->when(! empty($params['duration_to']), function (Builder $q) use ($params) {
                return $q->whereHas('tour', function ($sq) use ($params) {
                    return $sq->where('duration', '<=', $params['duration_to']);
                });
            })
            ->when(! empty($params['price_from']), function (Builder $q) use ($params) {
                return $q->where('price', '>=', $params['price_from']);
            })
            ->when(! empty($params['price_to']), function (Builder $q) use ($params) {
                return $q->where('price', '<=', $params['price_to']);
            })
            ->when(! empty($params['place_id']), function (Builder $q) use ($params) {
                return $q->whereHas('tour', function ($sq) use ($params) {
                    return $sq->whereHas('places', function (Builder $ssq) use ($params) {
                        $ids = array_filter(explode(',', $params['place_id']));
                        $ssq->whereIn('places.id', $ids);
                    });
                });
            })
            ->when(! empty($params['direction']), function (Builder $q) use ($params) {
                return $q->whereHas('tour', function ($sq) use ($params) {
                    return $sq->whereHas('directions', function (Builder $ssq) use ($params) {
                        $ids = array_filter(explode(',', $params['direction']));
                        $ssq->whereIn('id', $ids);
                    });
                });
            })
            ->when(! empty($params['type']), function (Builder $q) use ($params) {
                return $q->whereHas('tour', function ($sq) use ($params) {
                    return $sq->whereHas('types', function (Builder $ssq) use ($params) {
                        $ids = array_filter(explode(',', $params['type']));
                        $ssq->whereIn('id', $ids);
                    });
                });
            })
            ->when(! empty($params['subject']), function (Builder $q) use ($params) {
                return $q->whereHas('tour', function ($sq) use ($params) {
                    return $sq->whereHas('subjects', function (Builder $ssq) use ($params) {
                        $ids = array_filter(explode(',', $params['subject']));
                        $ssq->whereIn('id', $ids);
                    });
                });
            });

        return $query;
    }

    public function scopeTab($query, $tab)
    {
        switch ($tab) {
            case 'recruited':
                $query->whereDate('start_date', '>', Carbon::today())->where('published', 1);

                break;
            case 'progress':
                $query->whereDate('start_date', '<=', Carbon::today())->whereDate('end_date', '>=', Carbon::today())->where('published', 1);

                break;
            case 'finished':
                $query->whereDate('end_date', '<', Carbon::today())->where('published', 1);

                break;
            case 'canceled':
                $query->where('published', 0);

                break;
        }

        return $query;
    }
}
