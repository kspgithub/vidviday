<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Class HtmlBlock
 * Различные HTML блоки на страницах
 *
 * @package App\Models
 * @mixin IdeHelperHtmlBlock
 */
class HtmlBlock extends Model
{
    use HasTranslations;

    public $translatable = [
        'title',
        'text',
    ];

    protected $fillable = [
        'title',
        'text',
        'slug',
    ];
}
