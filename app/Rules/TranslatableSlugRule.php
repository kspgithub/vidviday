<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TranslatableSlugRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $items = [];
        if (! empty($value)) {
            foreach ($value as $locale => $slug) {
                $slug = trim($slug);
                if (! empty($slug)) {
                    if (in_array($slug, $items)) {
                        return false;
                    }
                    $items[] = $slug;
                }
            }
        }

        return true;
    }

    public function message(): string
    {
        return 'URL має бути унікальним для кожної мови';
    }
}
