<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourVoting extends Model
{
    use HasFactory;

    public const STATUS_NEW = 0;
    public const STATUS_PUBLISHED = 1;
    public const STATUS_BLOCKED = 2;

    protected $fillable = [
        'tour_id',
        'user_id',
        'status',
        'ip',
        'name',
        'email',
        'phone',
        'comment',
    ];


    public static function statuses()
    {
        return [
            self::STATUS_NEW => __('new'),
            self::STATUS_PUBLISHED => __('published'),
            self::STATUS_BLOCKED => __('blocked'),
        ];
    }

    public function scopePublished(Builder $q)
    {
        $q->where('status', TourVoting::STATUS_PUBLISHED);
    }

    public function getStatusTextAttribute()
    {
        return self::statuses()[$this->status] ?? '';
    }
}
