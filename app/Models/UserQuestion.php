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

    public const QUESTION_TYPES = [
        'tour' => 'Запитання що до туру',
        'certificate' => 'Запитання що до сертифікату',
        'other' => 'Інше питання',
    ];

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
        'bitrix_id',
        'bitrix_contact_id',
        'utm_campaign',
        'utm_content',
        'utm_medium',
        'utm_source',
        'utm_term',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'call_date',
    ];
}
