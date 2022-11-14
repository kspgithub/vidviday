<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

Collection::macro('translate', function () {
    return $this->transform(function ($item) {
        $data = $item->toArray();
        if ($item instanceof Model && $item->translatable) {
            foreach ($item->translatable as $attr) {
                $data[$attr] = $item->{$attr};
            }
        }

        return $data;
    });
});
