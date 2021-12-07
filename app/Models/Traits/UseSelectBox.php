<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait UseSelectBox
{
    public static function toSelectBox(
        $text_field = 'title',
        $value_field = 'id',
        $value_key = 'value',
        $text_key = 'text'
    ) {
        $fields = $text_field === $value_field ? [$text_field] : [$value_field, $text_field];

        return self::query()->get($fields)
            ->map(function ($item) use ($value_field, $text_field, $value_key, $text_key) {
                return [$value_key => $item->{$value_field}, $text_key => $item->{$text_field}];
            });
    }

    public static function toSelectWithOthersOptionsBox(
        $text_field = 'title',
        $value_field = 'id',
        $price_filed = "price",
        $currency_filed = "currency"
    ) {
        $fields = $text_field === $value_field ? [$text_field] : [$value_field, $text_field];

        $fields[] = $price_filed;
        $fields[] = $currency_filed;

        return self::query()->get($fields)
            ->map(function ($item) use ($value_field, $text_field, $price_filed, $currency_filed) {
                return [
                    'value' => $item->{$value_field},
                    'text' => "{$item->{$text_field}}({$item->{$price_filed ?? ""}} {$item->{$currency_filed ?? ""}})"
                ];
            });
    }

    public function scopeToSelectBox(
        Builder $query,
        $text_field = 'title',
        $value_field = 'id',
        $value_key = 'value',
        $text_key = 'text'
    ) {
        $fields = $text_field === $value_field ? [$text_field] : [$value_field, $text_field];
        return $query->get($fields)->map(function ($item) use ($value_field, $text_field, $value_key, $text_key) {
            return [$value_key => $item->{$value_field}, $text_key => $item->{$text_field}];
        });
    }

    public static function toSelectArray($text_field = 'title', $value_field = 'id')
    {
        $fields = $text_field === $value_field ? [$text_field] : [$value_field, $text_field];
        $result = [];
        $items = self::query()->get($fields);
        foreach ($items as $item) {
            $result[$item->{$value_field}] = $item->{$text_field};
        }
        return $result;
    }
}
