<?php

namespace App\Models;

use App\Models\Traits\Scope\JsonLikeScope;
use Spatie\Translatable\HasTranslations;
use Spatie\TranslationLoader\LanguageLine as SpatieLanguageLine;

class LanguageLine extends SpatieLanguageLine
{
    use JsonLikeScope;

    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param string $locale
     * @return bool
     */
    public function hasTranslation(string $locale)
    {
        return isset($this->text[$locale]) && !empty($this->text[$locale]);
    }

    public function getFullKeyAttribute()
    {
        return $this->group . '.' . $this->key;
    }
}
