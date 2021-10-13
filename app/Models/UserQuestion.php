<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserQuestion
 * Заказ звонка или письмо от пользователя
 *
 * @package App\Models
 * @mixin IdeHelperUserQuestion
 */
class UserQuestion extends Model
{
    use HasFactory;

    public const STATUS_NEW = 0;
    public const STATUS_RESOLVED = 1;
    public const STATUS_ARCHIVED = 2;

    public const TYPE_CALL = 0;
    public const TYPE_EMAIL = 1;
    public const TYPE_QUESTION = 2;

    protected $fillable = [
        'type',
        'status',
        'name',
        'phone',
        'email',
        'question_type',
        'comment',
        'call_date',
        'call_time',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'call_date',
    ];
}
