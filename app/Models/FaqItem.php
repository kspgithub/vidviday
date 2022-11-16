<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FaqItem extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;

    public const SECTION_COMMON = 'common';
    public const SECTION_CORPORATE = 'corporate';
    public const SECTION_TOURIST = 'tourist';
    public const SECTION_TOUR_AGENT = 'tour-agent';
    public const SECTION_CERTIFICATE = 'certificate';
    public const SECTION_TOUR = 'tour';
    public const SECTION_SCHOOL = 'school';


    public static $sections = [
//        self::SECTION_COMMON => 'Загальні питання',
        self::SECTION_CORPORATE => 'Корпоративному клієнту',
        self::SECTION_TOURIST => 'Туристу',
        self::SECTION_TOUR_AGENT => 'Турагенту',
        self::SECTION_CERTIFICATE => 'Сертифікат',
        self::SECTION_SCHOOL => 'Школам',
//        self::SECTION_TOUR => 'Тур',
    ];

    public static $sectionTitles = [
        self::SECTION_COMMON => [
            'uk' => 'Загальні питання',
            'ru' => 'Общие вопросы',
            'en' => 'General questions',
            'pl' => 'Ogólne pytania',
        ],
        self::SECTION_CORPORATE => [
            'uk' => 'Корпоративному клієнту',
            'ru' => 'Корпоративному клиенту',
            'en' => 'Corporate client',
            'pl' => 'Klient korporacyjny',
        ],
        self::SECTION_TOURIST => [
            'uk' => 'Туристу',
            'ru' => 'Туристу',
            'en' => 'Tourist',
            'pl' => 'Do turysty',
        ],
        self::SECTION_TOUR_AGENT => [
            'uk' => 'Турагенту',
            'ru' => 'Турагенту',
            'en' => 'Travel agent',
            'pl' => 'Agent biura podróży',
        ],
        self::SECTION_CERTIFICATE => [
            'uk' => 'Сертифікат',
            'ru' => 'Сертификат',
            'en' => 'Certificate',
            'pl' => 'Certyfikat',
        ],
        self::SECTION_TOUR => [
            'uk' => 'Тур',
            'ru' => 'Тур',
            'en' => 'Tour',
            'pl' => 'Wycieczka',
        ],
        self::SECTION_SCHOOL => [
            'uk' => 'Школам',
            'ru' => 'Школам',
            'en' => 'For schools',
            'pl' => 'Dla szkół',
        ],
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

    public static function getSection($section)
    {
        $locale = app()->getLocale();
        $items = self::query()->published()->where('section', $section)->orderBy('sort_order')->get();
        return (object)[
            'slug' => $section,
            'title' => self::$sectionTitles[$section][$locale],
            'items' => $items->where("section", $section)
        ];
    }

    public static function getBySections($sections = [])
    {
        $items = self::query()->published()->whereIn('section', $sections)->orderBy('sort_order')->get();
        $locale = app()->getLocale();
        $section_items = [];
        foreach ($sections as $section) {
            $section_items[] = (object)[
                'slug' => $section,
                'title' => self::$sectionTitles[$section][$locale],
                'items' => $items->where("section", $section)
            ];
        }
        return collect($section_items);
    }
}
