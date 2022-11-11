<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Contact extends TranslatableModel
{
    use HasTranslations;

    public $translatable = [
        'title',
        'address',
        'address_comment',
        'map_comment',
        'opening_hours',
    ];

    protected $fillable = [
        'title',
        'address',
        'address_comment',
        'map_comment',
        'opening_hours',
        'lat',
        'lng',
        'email',
        'work_phone',
        'phone_1',
        'phone_2',
        'phone_3',
        'skype',
        'viber',
        'telegram',
        'whatsapp',
        'messenger',
        'managers_corporate',
        'managers_agency',
    ];

    protected $casts = [
        'managers_corporate' => 'array',
        'managers_agency' => 'array',
    ];

    public function getManagerCorporateItemsAttribute($published = false)
    {
        $ids = $this->managers_corporate ?? [];
        if (! empty($ids)) {
            $q = Staff::whereIn('id', $ids);
            if ($published) {
                $q->where('published', 1);
            }
            $items = $q->withCount(['testimonials' => function ($q) {
                return $q->moderated();
            }])->get()->sortBy(fn ($it) => array_search($it->id, $ids));

            return $items;
        }

        return collect([]);
    }

    public function getManagerAgencyItemsAttribute($published = false)
    {
        $ids = $this->managers_agency ?? [];
        if (! empty($ids)) {
            $q = Staff::whereIn('id', $ids);
            if ($published) {
                $q->where('published', 1);
            }
            $items = $q->withCount(['testimonials' => function ($q) {
                return $q->moderated();
            }])->get()->sortBy(fn ($it) => array_search($it->id, $ids));

            return $items;
        }

        return collect([]);
    }
}
