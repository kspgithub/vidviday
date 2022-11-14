<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderTransport extends Model
{
    use SoftDeletes;

    public const STATUS_NEW = 'new';

    public const STATUS_PROCESSING = 'processing';

    public const STATUS_COMPLETED = 'completed';

    public const STATUS_REJECTED = 'rejected';

    public static function statuses()
    {
        return [
            self::STATUS_NEW => __('New'),
            self::STATUS_PROCESSING => __('Processing'),
            self::STATUS_COMPLETED => __('Completed'),
            self::STATUS_REJECTED => __('Rejected'),
        ];
    }

    public static function ageGroups()
    {
        return [
            'to-6' => 'До 6 років',
            '6-12' => 'Від 6 до 12 років',
            '12-18' => 'Від 12 до 18 років',
            'from-18' => 'Від 18 років',
        ];
    }

    protected $fillable = [
        'user_id',
        'status',
        'first_name',
        'last_name',
        'email',
        'phone',
        'viber',
        'route',
        'start_date',
        'end_date',
        'duration',
        'places',
        'age_group',
        'comment',
    ];

    protected $casts = [
        'age_group' => 'array',
        'start_date' => 'date:d.m.Y',
        'end_date' => 'date:d.m.Y',
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAgeGroupTitleAttribute()
    {
        $availableGroups = self::ageGroups();
        $title = [];
        $ageGroups = $this->age_group ?? [];
        foreach ($ageGroups as $ageGroup) {
            $title[] = isset($availableGroups[$ageGroup]) ? $availableGroups[$ageGroup] : $ageGroup;
        }

        return implode(', ', $title);
    }
}
