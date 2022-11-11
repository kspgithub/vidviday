<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\TourDiscount
 *
 * @OA\Schema(
 *     schema="TourDiscount",
 *     type="object",
 *     description="Знижка туру",
 *     @OA\Property(
 *         property="id",
 *         title="ID",
 *         example="2",
 *         type="integer",
 *     ),
 *     @OA\Property(
 *         property="title",
 *         title="Назва",
 *         type="object",
 *         example={ "uk": "Учасникам АТО/ООС (за наявності посвідчення): знижка 30% від вартості туру", "ru": "Участникам АТО/ООС (при наличии удостоверения): скидка 30% от стоимости тура", "en": "ATO participants (at the presence of a certificate): discount 30% from the cost of the tour", "pl": "Uczestnicy ATO (za okazaniem certyfikatu): zniżka 30% z kosztu wycieczki" }
 *     ),
 *     @OA\Property(
 *         property="type",
 *         title="Тип",
 *         type="string",
 *         enum={"percent", "value"},
 *         default="percent",
 *         example="percent",
 *     ),
 *     @OA\Property(
 *         property="currency",
 *         title="Валюта",
 *         type="string",
 *         example="UAH",
 *     ),
 *     @OA\Property(
 *         property="price",
 *         title="Знижка",
 *         type="integer",
 *         example="30",
 *     ),
 *     @OA\Property(
 *         property="category",
 *         title="Категорія",
 *         type="string",
 *         enum={"all", "adult", "children", "children_young", "children_older"},
 *         default="adult",
 *         example="adult",
 *     ),
 *     @OA\Property(
 *         property="duration",
 *         title="Знижка за",
 *         type="string",
 *         enum={"order", "unit", "day", "person", "person-day"},
 *         default="person",
 *         example="person",
 *     ),
 *     @OA\Property(
 *         property="age_limit",
 *         title="Обмеження за віком",
 *         type="boolean",
 *         example="false",
 *     ),
 *     @OA\Property(
 *         property="age_start",
 *         title="Вік з",
 *         type="integer",
 *         example="0",
 *     ),
 *     @OA\Property(
 *         property="age_end",
 *         title="Вік по",
 *         type="integer",
 *         example="3",
 *     ),
 * ),
 */
class TourDiscountResource extends JsonResource
{
    /**
     * @param Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslations('title'),
            'type' => $this->type,
            'price' => $this->price,
            'currency' => $this->currency,
            'category' => $this->category,
            'duration' => $this->duration,
            'age_limit' => (bool) $this->age_limit,
            'age_start' => $this->age_start,
            'age_end' => $this->age_end,
        ];
    }
}
