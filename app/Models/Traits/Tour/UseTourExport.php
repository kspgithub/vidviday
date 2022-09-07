<?php

namespace App\Models\Traits\Tour;

use App\Http\Resources\TourAccommodationResource;
use App\Http\Resources\TourDiscountResource;
use App\Http\Resources\TourFoodResource;
use App\Http\Resources\TourLandingResource;
use App\Http\Resources\TourTicketResource;

trait UseTourExport
{

    public function getImagesToExport()
    {
        return $this->getMedia('pictures')->map(fn($it) => $it->getFullUrl('normal'));
    }

    public function getTypesToExport()
    {
        return $this->types->map(fn($it) => ['title' => $it->getTranslations('title')]);
    }

    public function getSubjectsToExport()
    {
        return $this->subjects->map(fn($it) => ['title' => $it->getTranslations('title')]);
    }

    public function getDirectionsToExport()
    {
        return $this->directions->map(fn($it) => ['title' => $it->getTranslations('title')]);
    }

    public function getAdditionalInfoToExport()
    {
        return $this->hutsul_fun_on
            ? ['title' => $this->getTranslations('hutsul_fun_title'), 'text' => $this->getTranslations('hutsul_fun_text')]
            : null;
    }


    public function getPlacesToExport()
    {
        return $this->places->map(function ($it) {
            return [
                'title' => $it->getTranslations('title'),
                'text' => $it->getTranslations('text'),
                'lat' => $it->lat,
                'lng' => $it->lng,
                'video' => $it->video,
                'rating' => $it->rating,
                'country' => $it->country ? $it->country->getTranslations('title') : null,
                'region' => $it->region ? $it->region->getTranslations('title') : null,
                'district' => $it->district ? $it->district->getTranslations('title') : null,
                'city' => $it->city ? $it->city->getTranslations('title') : null,
                'direction' => $it->direction ? $it->direction->getTranslations('title') : null,
                'images' => $it->getMedia()->map(fn($media) => $media->getFullUrl()),
            ];
        });
    }

    public function getIncludesToExport()
    {
        $result = [];
        foreach ($this->tourIncludes as $include) {
            if (!isset($result[$include->type_id])) {
                $result[$include->type_id] = [
                    'id' => $include->type_id,
                    'title' => $include->type->getTranslations('title'),
                    'items' => []
                ];
            }
            $result[$include->type_id]['items'][] = $include->finance ? $include->finance->getTranslations('text') : [];
        }
        return array_values($result);
    }


    public function getPlanToExport()
    {
        return $this->planItems->where('published', '=', true)->map(fn($it) => $it->getTranslations('text'))->first();
    }

    public function getFoodToExport()
    {
        return TourFoodResource::collection($this->foodItems);
    }


    public function getAccommodationToExport()
    {
        return TourAccommodationResource::collection($this->tourAccommodations);
    }

    public function getTicketsToExport()
    {
        return TourTicketResource::collection($this->tickets);
    }

    public function getDiscountsToExport()
    {
        return TourDiscountResource::collection($this->discounts);
    }


    public function getLandingsToExport()
    {
        return TourLandingResource::collection($this->landings);
    }
}
