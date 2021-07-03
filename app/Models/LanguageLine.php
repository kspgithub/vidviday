<?php

namespace App\Models;

use Spatie\TranslationLoader\LanguageLine as SpatieLanguageLine;

/**
 * Class LanguageLine
 * Переводы строк
 *
 * @package App\Models
 * @mixin IdeHelperLanguageLine
 */
class LanguageLine extends SpatieLanguageLine
{
    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
