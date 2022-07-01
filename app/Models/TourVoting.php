<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourVoting extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'user_id',
        'ip',
        'first_name',
        'last_name',
        'email',
        'phone',
        'comment',
    ];
}
