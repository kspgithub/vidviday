<?php

namespace App\Models;

use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Currency extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;
    use UseSelectBox;

    protected static $currencies = null;

    protected static $iso_names = null;

    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'title',
        'symbol',
        'iso',
        'course',
        'slug',
    ];

    public static function isoNames()
    {
        if (self::$iso_names === null) {
            self::$iso_names = self::query()->select('iso')->pluck('iso')->toArray();
        }

        return self::$iso_names;
    }

    public static function allCached()
    {
        if (self::$currencies === null) {
            $currencies = self::query()->get();
            $array = [];
            foreach ($currencies as $currency) {
                $array[$currency->iso] = $currency;
            }
            self::$currencies = $array;
        }
        return self::$currencies;
    }

    public static function currencyTitle($iso)
    {
        $currencies = self::allCached();
        return array_key_exists($iso, $currencies) ? $currencies[$iso]->title : $iso;
    }

    public static function toLocal(int $value, string $currency = 'UAH')
    {
        $currencies = self::allCached();
        $iso = session('currency', 'UAH');
        $currentCurrency = $currencies[$iso] ?? null;
        $modelCurrency = $currencies[$currency] ?? null;

        if($currentCurrency && $modelCurrency) {
            $currentValue = ceil(($value * $modelCurrency->course) / $currentCurrency->course);

            return $currentValue;
        }

        throw new \Exception('Unknown Currency.');
    }

    public static function currentCourse()
    {
        $currencies = self::allCached();
        $iso = session('currency', 'UAH');
        $currentCurrency = $currencies[$iso] ?? null;

        if($currentCurrency) {
            return $currentCurrency->course;
        }

        throw new \Exception('Unknown Currency.');
    }
}
