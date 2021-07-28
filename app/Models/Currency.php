<?php

namespace App\Models;

use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Class Currency
 *
 * @package App\Models
 * @mixin IdeHelperCurrency
 */
class Currency extends Model
{
    use HasFactory;
    use HasTranslations;
    use UseSelectBox;

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
}
