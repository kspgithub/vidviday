<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\TourInclude
 *
 * @OA\Schema(
 *     schema="TourInclude",
 *     type="object",
 *     description="Зміст туру",
 *     @OA\Property(
 *         property="id",
 *         title="ID",
 *         example="48",
 *         type="integer",
 *     ),
 *     @OA\Property(
 *         property="title",
 *         title="Назва категорії",
 *         type="object",
 *         example= { "uk": "У вартість туру входить", "ru": "В стоимость тура входит", "en": "The tour price includes", "pl": "Cena wycieczki obejmuje" }
 *     ),
 *     @OA\Property(
 *         property="items",
 *         title="Зміст",
 *         type="array",
 *         @OA\Items( type="object", example={"uk": "проїзд комфортабельним автобусом", "en": "travel by comfortable bus", "ru": "проезд комфортабельным автобусом",  "pl": "przejazd wygodnym autobusem" }),
 *     ),
 * ),
 */
class TourIncludeResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->type_id,
            'title' => $this->type->getTranslations('title'),
            'items' => [],
        ];
    }
}
