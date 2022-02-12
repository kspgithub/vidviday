<?php

namespace App\Models;

use App\Models\Traits\UseSelectBox;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Discount extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;
    use HasSlug;
    use UseSelectBox;


    public const TYPE_VALUE = 'value';
    public const TYPE_PERCENT = 'percent';

    public const CATEGORY_ALL = 'all';
    public const CATEGORY_ADULT = 'adult';
    public const CATEGORY_CHILDREN = 'children';
    public const CATEGORY_CHILDREN_YOUNG = 'children_young';
    public const CATEGORY_CHILDREN_OLDER = 'children_older';

    public const DURATION_ORDER = 'order';
    public const DURATION_UNIT = 'unit';
    public const DURATION_DAY = 'day';
    public const DURATION_PERSON = 'person';
    public const DURATION_PERSON_DAY = 'person-day';


    public static $types = [
        self::TYPE_VALUE => 'грн',
        self::TYPE_PERCENT => '%',
    ];

    public static $categories = [
        self::CATEGORY_ALL => 'всі',
        self::CATEGORY_ADULT => 'дорослі',
        self::CATEGORY_CHILDREN => 'всі діти',
        self::CATEGORY_CHILDREN_YOUNG => 'діти молодшого віку',
        self::CATEGORY_CHILDREN_OLDER => 'діти старшого віку',
    ];

    public static $durations = [
        self::DURATION_PERSON => 'за кожну персону',
        self::DURATION_PERSON_DAY => 'за кожну персону, за кожен день туру',
        self::DURATION_ORDER => 'за замовлення',
        self::DURATION_DAY => 'за всіх, за кожен день туру',
        self::DURATION_UNIT => 'за одиницю товару',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public $translatable = [
        'title',
    ];


    protected $fillable = [
        "title",
        "admin_title",
        "type",
        "category",
        "duration",
        "age_limit",
        "age_start",
        "age_end",
        "slug",
        'price',
        'currency',
        'start_date',
        'end_date',
        'published',
    ];

    protected $casts = [
        'price' => 'integer',
        'published' => 'boolean',
        'age_limit' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'start_date',
        'end_date',
    ];

    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at',
    ];

    public function scopeAvailable(Builder $query)
    {
        return $query->where('published', 1)
            ->where(function ($q) {
                $q->whereNull('start_date')->orWhereDate('start_date', '<=', Carbon::now()->startOfDay());
            })
            ->where(function ($q) {
                $q->whereNull('end_date')->orWhereDate('end_date', '>=', Carbon::now()->endOfDay());
            });
    }

    /**
     * Tours
     *
     * @return BelongsToMany
     */
    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tours_discounts', 'tour_id', 'discount_id');
    }


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }

    /**
     * Подсчитывает скидку
     * @param int $price Цена за единицу
     * @param int $quantity Количество единиц
     * @param int $days Количество дней (для скидок на каждый день)
     * @return float|int
     */
    public function calculate($price = 0, $quantity = 1, $days = 1)
    {

        $amount = ($this->type === self::TYPE_VALUE ? ($this->price) : (round($price / 100 * $this->price)));
        $total = 0;
        switch ($this->duration) {
            case self::DURATION_PERSON:
            case self::DURATION_UNIT:
                $total = $amount * $quantity;
                break;
            case self::DURATION_PERSON_DAY:
                $total = $amount * $quantity * $days;
                break;
            case self::DURATION_DAY:
                $total = $amount * $days;
                break;
            case self::DURATION_ORDER:
                $total = $amount;
                break;
        }
        return $total;
    }

    public function asAlpineData()
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'price' => $this->price,
            'currency' => $this->currency,
            'title' => json_prepare($this->title),
            'admin_title' => json_prepare($this->admin_title),
        ];
    }
}
