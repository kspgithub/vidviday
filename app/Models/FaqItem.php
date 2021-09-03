<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Class FaqItem
 *
 * @package App\Models
 * @mixin IdeHelperFaqItem
 */
class FaqItem extends Model
{
    use HasFactory;
    use HasTranslations;

    public const SECTION_COMMON = 'common';
    public const SECTION_CORPORATE = 'corporate';
    public const SECTION_TOURIST = 'tourist';
    public const SECTION_TOUR_AGENT = 'tour-agent';
    public const SECTION_CERTIFICATE = 'certificate';
    public const SECTION_TOUR = 'tour';


    public static $sections = [
        self::SECTION_COMMON => 'Загальні питання',
        self::SECTION_CORPORATE => 'Корпоративи',
        self::SECTION_TOURIST => 'Туристу',
        self::SECTION_TOUR_AGENT => 'Турагенту',
        self::SECTION_CERTIFICATE => 'Сертифікат',
        self::SECTION_TOUR => 'Тур',
    ];

    public $translatable = [
        'question',
        'answer',
    ];

    protected $fillable = [
        'section',
        'question',
        'answer',
        'sort_order',
        'published',
    ];
}
