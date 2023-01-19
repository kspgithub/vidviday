<?php

namespace App\Observers;

use App\Mail\OrderNoteEmail;
use App\Models\OrderNote;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderNoteObserver
{
    public function retrieved(OrderNote $orderNote)
    {
    }

    public function creating(OrderNote $orderNote)
    {
    }

    public function created(OrderNote $orderNote)
    {
        try {
            $order = $orderNote->order;

            $manager = $order->tour?->manager;

            if ($manager && $manager->email) {
                Mail::to($manager->email)->queue(new OrderNoteEmail($orderNote));
            }
        } catch (\Exception $e) {
            Log::error('OrderNoteEmail failed: ' . $e->getMessage());
        }
    }

    public function updating(OrderNote $orderNote)
    {
    }

    public function updated(OrderNote $orderNote)
    {
    }

    public function saving(OrderNote $orderNote)
    {
    }

    public function saved(OrderNote $orderNote)
    {
    }

    public function restoring(OrderNote $orderNote)
    {
    }

    public function restored(OrderNote $orderNote)
    {
    }

    public function replicating(OrderNote $orderNote)
    {
    }

    public function deleting(OrderNote $orderNote)
    {
    }

    public function deleted(OrderNote $orderNote)
    {
    }

    public function forceDeleted(OrderNote $orderNote)
    {
    }
}
