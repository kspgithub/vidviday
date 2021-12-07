<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperOrderNote
 */
class OrderNote extends Model
{
    use HasFactory;

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
