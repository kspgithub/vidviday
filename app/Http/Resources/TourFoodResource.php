<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\TourFood
 *
 * @OA\Schema(
 *     schema="TourFood",
 *     type="object",
 *     description="Зміст туру",
 *     @OA\Property(
 *         property="id",
 *         title="ID",
 *         example="2",
 *         type="integer",
 *     ),
 *     @OA\Property(
 *         property="day",
 *         title="День",
 *         example="1",
 *         type="integer",
 *     ),
 *     @OA\Property(
 *         property="time",
 *         title="Час",
 *         type="object",
 *         example={ "uk": "Сніданок", "ru": "Завтрак", "en": "Breakfast", "pl": "Śniadanie" }
 *     ),
 *     @OA\Property(
 *         property="text",
 *         title="Текст",
 *         type="object",
 *         example={ "uk": "Можна поснідати вдома, взяти з собою перекус", "ru": "Можно позавтракать дома или взять бутерброды", "en": "You can have breakfast at home, bring snacks", "pl": "Można zjeść śniadanie w domu, wziąć ze sobą przekąski" }
 *     ),
 *     @OA\Property(
 *         property="price",
 *         title="Вартість",
 *         example="0",
 *         type="integer",
 *     ),
 *     @OA\Property(
 *         property="currency",
 *         title="Валюта",
 *         example="UAH",
 *         type="string",
 *     ),
 *     @OA\Property(
 *         property="images",
 *         title="Зображення",
 *         type="array",
 *         @OA\Items( type="string", example="https://vidviday.ua/storage/media/tour/3758/conversions/mukachevo-zamok-palanok-yuriy-krylivets-thumb.jpg",)
 *     ),
 * ),
 */
class TourFoodResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->food->id,
            'time' => $this->time->getTranslations('title'),
            'text' => $this->food->getTranslations('text'),
            'day' => $this->day,
            'price' => $this->food->price,
            'currency' => $this->food->currency,
            'images' => $this->food->getMedia()->map(fn($it) => $it->getFullUrl('normal'))
        ];
    }
}
