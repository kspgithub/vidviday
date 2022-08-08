<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WrongQuery extends Model
{
    use HasFactory;

    protected $fillable = [
        'query',
        'count',
    ];
}
