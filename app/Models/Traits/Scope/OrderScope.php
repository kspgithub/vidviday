<?php

namespace App\Models\Traits\Scope;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

trait OrderScope
{
    public function scopeFilter($query, Request $request = null)
    {
        if ($request === null) {
            $request = request();
        }

        $manager_id = $request->input('manager_id', 0);

        if ($manager_id > 0) {
            $query->whereHas('tour', fn ($sq) => $sq->whereHas('manager', fn ($ssq) => $ssq->where('id', $manager_id)));
        }

        $tour_id = $request->input('tour_id', 0);
        if ($tour_id > 0) {
            $query->where('tour_id', $tour_id);
        }

        $status = $request->input('status', '');
        if (! empty($status)) {
            $query->where('status', $status);
        }

        $dates = $request->input('dates', '');
        if (! empty($dates)) {
            $dateParts = array_filter(explode('-', $dates));
            if (! empty($dateParts[0])) {
                $query->whereDate('start_date', '>=', Carbon::createFromFormat('d.m.Y', $dateParts[0]));
            }
            if (! empty($dateParts[1])) {
                $query->whereDate('start_date', '<=', Carbon::createFromFormat('d.m.Y', $dateParts[1]));
            }
        }

        $order = explode(':', $request->input('order', 'created_at:desc'));
        $query->orderBy($order[0] ?? 'created_at', $order[1] ?? 'desc');

        return $query;
    }
}
