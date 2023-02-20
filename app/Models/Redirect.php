<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    use HasFactory;

    const TYPE_FULL = 'full';
    const TYPE_PARTIAL = 'partial';
    const TYPE_REGEX = 'regex';

    protected $fillable = [
        'type',
        'from',
        'to',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function scopePublished(Builder $q)
    {
        return $q->where('published', 1);
    }
}
