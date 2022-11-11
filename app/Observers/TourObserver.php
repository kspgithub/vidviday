<?php

namespace App\Observers;

use App\Models\Tour;
use Illuminate\Support\Str;

class TourObserver
{
    /**
     * генерируем короткий текст если он не было передан
     *
     * @param  \App\Models\Tour  $tour
     * @return void
     */
    public function creating(Tour $tour)
    {
        if (empty($tour->short_text)) {
            $tour->short_text = Str::limit(strip_tags($tour->text), 500);
        }
    }

    /**
     * Handle the TourVoting "updated" event.
     *
     * @param  \App\Models\Tour  $tour
     * @return void
     */
    public function updating(Tour $tour)
    {
        if (empty($tour->short_text)) {
            $tour->short_text = Str::limit(strip_tags($tour->text), 500);
        }

        if ($tour->isDirty(['price', 'accomm_price'])) {
            foreach ($tour->orders as $order) {
                if ($order->group_type === 0) {
                    $order->recalculatePrice();
                }
            }
        }
    }

    /**
     * Handle the TourVoting "updated" event.
     *
     * @param  \App\Models\Tour  $tour
     * @return void
     */
    public function updated(Tour $tour)
    {
        // Recalculate schedules end_dates
        if ($tour->isDirty(['duration', 'nights'])) {
            foreach ($tour->scheduleItems as $scheduleItem) {
                $scheduleItem->update(['end_date' => $scheduleItem->calculateEndDate()]);
            }
        }
    }
}
