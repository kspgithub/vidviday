<?php

namespace App\Models\Traits;

trait UseSelectBox
{
    public static function toSelectBox($text_field = 'title', $value_field = 'id')
    {
        $fields = $text_field === $value_field ? [$text_field] : [$value_field, $text_field];

        return self::query()->get($fields)->map(function ($item) use ($value_field, $text_field) {
            return ['value' => $item->{$value_field}, 'text'=> $item->{$text_field}];
        });
    }
}
