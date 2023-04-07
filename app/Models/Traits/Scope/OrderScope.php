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

        // ID заказа
        $order_id = $request->input('order_id', 0);
        if ($order_id > 0) {
            $query->find($order_id);
        }

        // Дата заказа
        $created_dates = $request->input('created_dates', '');
        $created_dates__interval = $request->input('created_dates__interval', 0);
        if (!empty($created_dates)) {
            if( $created_dates__interval == 1){
                // Интервал
                $created_dateParts = array_filter(explode('-', $created_dates));
                if (!empty($created_dateParts[0])) {
                    $query->whereDate('created_at', '>=', Carbon::createFromFormat('d.m.Y', $created_dateParts[0]));
                }
                if (!empty($created_dateParts[1])) {
                    $query->whereDate('created_at', '<=', Carbon::createFromFormat('d.m.Y', $created_dateParts[1]));
                }
            } else {
                // Точная дата
                if (!empty($created_dates)) {
                    $query->whereDate('created_at', '=', Carbon::createFromFormat('d.m.Y', $created_dates));
                }
            }
        }

        // Менеджер
        $manager_id = $request->input('manager_id', 0);
        if ($manager_id > 0) {
            $query->whereHas('tour', fn ($sq) => $sq->whereHas('manager', fn ($ssq) => $ssq->where('id', $manager_id)));
        }

        // Тур
        $tour_id = $request->input('tour_id', 0);
        if ($tour_id > 0) {
            $query->where('tour_id', $tour_id);
        }

        // Статус
        $status = $request->input('status', '');
        if (!empty($status)) {
            $query->where('status', $status);
        }

        // Дата выезда
        $dates = $request->input('dates', '');
        $dates__interval = $request->input('dates__interval', 0);
        if (!empty($dates)) {
            if( $dates__interval == 1){
                // Интервал
                $dateParts = array_filter(explode('-', $dates));
                if (!empty($dateParts[0])) {
                    $query->whereDate('start_date', '>=', Carbon::createFromFormat('d.m.Y', $dateParts[0]));
                }
                if (!empty($dateParts[1])) {
                    $query->whereDate('start_date', '<=', Carbon::createFromFormat('d.m.Y', $dateParts[1]));
                }
            } else {
                // Точная дата
                if (!empty($dates)) {
                    $query->whereDate('start_date', '=', Carbon::createFromFormat('d.m.Y', $dates));
                }
            }
        }

        // Тур фирма
        $company = $request->input('company', '');
        if (!empty($company)) {
            $query->WhereRaw("company LIKE '%$company%'");
        }

        // ФИО
        $contact = $request->input('contact', '');
        if (!empty($contact)) {
            $query->whereRaw("CONCAT_WS(' ', last_name, first_name, middle_name) LIKE '%$contact%'");
        }

        // Телефон
        $phone = $request->input('phone', '');
        if (!empty($phone)) {
            $query->WhereRaw("phone LIKE '%$phone%'");
        }

        // Email
        $email = $request->input('email', '');
        if (!empty($email)) {
            $query->WhereRaw("email LIKE '%$email%'");
        }

        // Email
        $places = $request->input('places', 0);
        if (!empty($places)) {
            $query->$query->where('places', $places);
        }

        $order = explode(':', $request->input('order', 'created_at:desc'));
        $query->orderBy($order[0] ?? 'created_at', $order[1] ?? 'desc');
        return $query;
    }
}
