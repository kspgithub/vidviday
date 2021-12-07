<?php

namespace App\Models\Traits\Relationship;

use App\Models\OrderNote;
use App\Models\PaymentType;
use App\Models\Tour;
use App\Models\TourSchedule;
use App\Models\User;

trait OrderRelationship
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function payment()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type');
    }

    public function schedule()
    {
        return $this->belongsTo(TourSchedule::class, 'schedule_id');
    }

    public function notes()
    {
        return $this->hasMany(OrderNote::class, 'order_id')->orderBy('created_at', 'desc');
    }
}
