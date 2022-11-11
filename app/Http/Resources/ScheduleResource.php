<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\TourSchedule
 *
 * @OA\Schema(
 *     schema="Schedule",
 *     type="object",
 *     @OA\Property(
 *         property="id",
 *         title="ID",
 *         type="integer",
 *         example="412"
 *     ),
 *     @OA\Property(
 *         property="start_date",
 *         title="Дата виїзду",
 *         type="string",
 *         example="12.08.2022"
 *     ),
 *     @OA\Property(
 *         property="end_date",
 *         title="Дата повернення",
 *         type="string",
 *         example="14.08.2022"
 *     ),
 *     @OA\Property(
 *         property="places_total",
 *         title="Місць усього",
 *         type="integer",
 *         example="9"
 *     ),
 *     @OA\Property(
 *         property="places_available",
 *         title="Місць доступно для замовлення",
 *         type="integer",
 *         example="9"
 *     ),
 *     @OA\Property(
 *         property="price",
 *         title="Вартість туру, з особи",
 *         type="integer",
 *         example="1445",
 *     ),
 *     @OA\Property(
 *         property="accommodation_price",
 *         title="Доплата за поселення",
 *         description="Доплата за поселення, у випадку замовлення одномісного номеру",
 *         type="integer",
 *         example="0",
 *     ),
 *     @OA\Property(
 *         property="currency",
 *         title="Валюта",
 *         type="string",
 *         example="UAH",
 *     ),
 *     @OA\Property(
 *         property="comment",
 *         title="Коментар щодо конкретного виїзду",
 *         type="string",
 *         example="",
 *     ),
 * ),
 */
class ScheduleResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'start_date' => $this->start_date->format('d.m.Y'),
            'end_date' => $this->end_date->format('d.m.Y'),
            'places_total' => $this->places,
            'places_available' => $this->places_available,
            'price' => $this->price,
            'accommodation_price' => $this->accomm_price,
            'currency' => $this->currency,
            //            'comment' => $this->comment,
        ];
    }
}
