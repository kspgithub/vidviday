<?php

namespace App\Models\Traits\Attributes;

use App\Models\FoodTime;
use App\Models\IncludeType;
use App\Models\TourPlan;

trait TourAttribute
{
    protected $tourGuides = null;

    protected $tourManager = null;


    public function getUrlAttribute()
    {
        return !empty($this->slug) ? '/' . $this->slug : '';
    }


    public function getMainImageAttribute()
    {
        $media = $this->getFirstMedia('main');

        // TODO: Заменить на no image
        return $media === null ? asset('img/no-image.png') : $media->getUrl('thumb');
    }


    public function getMobileImageAttribute()
    {
        $media = $this->getFirstMedia('mobile');

        // TODO: Заменить на no image
        return $media === null ? asset('img/no-image.png') : $media->getUrl();
    }


    public function getTourGuidesAttribute()
    {
        if ($this->tourGuides === null) {
            $this->tourGuides = $this->staff()->onlyExcursionLeaders()->get();
        }
        return $this->tourGuides;
    }

    public function getTourManagerAttribute()
    {
//        if ($this->tourManager === null) {
//            $this->tourManager = $this->staff()->onlyTourManagers()->first();
//        }
//        return $this->tourManager;

        return $this->manager;
    }


    public function getGroupTourIncludesAttribute()
    {
        return collect(IncludeType::all()->map(function ($type) {
            return (object)[
                'id' => $type->id,
                'title' => $type->title,
                'items' => $this->tourIncludes->where('type_id', $type->id),
            ];
        }));
    }

    public function getGroupFoodItemsAttribute()
    {
        $locale = app()->getLocale();
        $days = [];
        foreach ($this->foodItems as $foodItem) {
            if (!isset($days[$foodItem->day])) {
                $days[$foodItem->day] = (object)[
                    'title' => $foodItem->day . (in_array($locale, ['uk', 'ru']) ? '-й день' : __('day')),
                    'times' => collect([]),
                ];
            }
            $days[$foodItem->day]->times->add($foodItem);
        }
        return collect($days);
    }


    public function getDiscountTitleAttribute()
    {
        $title = [];
        foreach ($this->discounts as $discount) {
            $title[] = !empty($discount->admin_title) ? $discount->admin_title : $discount->title;
        }
        return implode('<br> ', $title);
    }

    /**
     * План
     *
     * @return TourPlan
     */
    public function getPlanAttribute()
    {
        return $this->planItems()->firstOrNew(['tour_id' => $this->id]);
    }
}
