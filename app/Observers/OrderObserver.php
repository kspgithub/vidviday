<?php

namespace App\Observers;

use App\Models\Order;
use Illuminate\Support\Str;

class OrderObserver
{
    public function retrieved(Order $order)
    {

    }

    public function creating(Order $order)
    {
        $order->price = $order->price ?: 0;
        $order->commission = $order->commission ?: 0;

        if($order->participants['customer'] ?? false) {
            $order->birthday = $order->participants['items'][0]['birthday'] ?? null;
        }
    }

    public function created(Order $order)
    {
        $order::disableAuditing();
        $order->order_number = Str::padLeft($order->id, 5, '0');
        $order->save();
        $order::enableAuditing();
    }

    public function updating(Order $order)
    {
        $forbiddenStatuses = [Order::STATUS_BOOKED, Order::STATUS_DEPOSIT, Order::STATUS_PAYED, Order::STATUS_COMPLETED];
        if ($order->status !== Order::STATUS_RESERVE && $order->isOverloaded() && in_array($order->status, $forbiddenStatuses)) {
            $status = in_array($order->getOriginal('status'), $forbiddenStatuses) ? Order::STATUS_RESERVE : $order->getOriginal('status');
            $order->status = $status;
        }
//            if($order->total_price > 0 && $order->payment_get > 0 && $order->payment_get < $order->total_price){
//                $order->status = Order::STATUS_DEPOSIT;
//            }
//            if($order->total_price > 0 && $order->payment_get <= 0){
//                $order->status = Order::STATUS_PAYED;
//            }

        // Sync order birthday if participant is customer
        if ($order->isDirty('birthday') && $order->participants['customer']) {
            $participants = $order->participants;
            if($participants['items'][0] ?? false) {
                $participants['items'][0]['birthday'] = $order->birthday->format('d.m.Y');
                $order->participants = $participants;
            }
        }
        if ($order->isDirty('participants')) {
            $participantsOriginal = $order->getOriginal('participants');
            $participants = $order->participants;
            if(
                $participantsOriginal &&
                $participants['customer'] && $participantsOriginal['customer'] &&
                !empty($participants['items'][0]) && !empty($participantsOriginal['items'][0]) &&
                $participantsOriginal['items'][0]['birthday'] !== $participants['items'][0]['birthday']
            ) {
                $order->birthday = $participants['items'][0]['birthday'];
            }
        }
    }

    public function updated(Order $order)
    {

    }

    public function saving(Order $order)
    {

    }

    public function saved(Order $order)
    {

    }

    public function restoring(Order $order)
    {

    }

    public function restored(Order $order)
    {

    }

    public function replicating(Order $order)
    {

    }

    public function deleting(Order $order)
    {

    }

    public function deleted(Order $order)
    {

    }

    public function forceDeleted(Order $order)
    {

    }
}
