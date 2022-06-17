<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TourDiscount extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $table = 'tours_discounts';

    const TYPE_TEMPLATE = 1;
    const TYPE_CUSTOM = 2;

    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'discount_id',
        'title',
        'admin_title',
        'type_id',
        'type',
        'category',
        'duration',
        'age_limit',
        'age_start',
        'age_end',
        'slug',
        'price',
        'currency',
        'start_date',
        'end_date',
        'position',
    ];

    protected $casts = [
        'price' => 'integer',
        'published' => 'boolean',
        'age_limit' => 'boolean',
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    public function discount()
    {
        return $this->belongsTo(Discount::class);
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

        $amount = ($this->type === Discount::TYPE_VALUE ? ($this->price) : (round($price / 100 * $this->price)));
        $total = 0;
        switch ($this->duration) {
            case Discount::DURATION_PERSON:
            case Discount::DURATION_UNIT:
                $total = $amount * $quantity;
                break;
            case Discount::DURATION_PERSON_DAY:
                $total = $amount * $quantity * $days;
                break;
            case Discount::DURATION_DAY:
                $total = $amount * $days;
                break;
            case Discount::DURATION_ORDER:
                $total = $amount;
                break;
        }
        return $total;
    }

    public function asAlpineData()
    {
        $data = $this->toArray();
        $data['title'] = json_prepare($this->title);
        $data['admin_title'] = json_prepare($this->admin_title);
        return $data;
    }
}
