<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderNote extends Model
{

    protected $fillable = [
        'text',
        'order_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
