<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\TourLanding
 *
 * @OA\Schema(
 *     schema="TourLanding",
 *     type="object",
 *     description="Місце посадки",
 *     @OA\Property(
 *         property="id",
 *         title="ID",
 *         example="48",
 *         type="integer",
 *     ),
 *     @OA\Property(
 *         property="title",
 *         title="Назва",
 *         type="object",
 *         example= { "en": "Lviv, Hotel Lviv", "pl": "Lwów, Hotel Lwów", "ru": "Львов, отель Львов", "uk": "Львів, готель Львів" }
 *     ),
 *     @OA\Property(
 *         property="description",
 *         title="Опис",
 *         type="object",
 *         example={ "en": "Hotel Lviv, 7 V. Chornovola Ave", "pl": "Hotel Lviv (al. W. Chornowoła, 7)", "ru": "Отель Львов (г. Львов, пр. В. Чорновола, 7)", "uk": "Готель Львів (м. Львів, пр. В. Чорновола, 7)"}
 *     ),
 *     @OA\Property(
 *         property="lat",
 *         title="Lattitude",
 *         type="float",
 *         example="49.845347727792",
 *     ),
 *     @OA\Property(
 *         property="lng",
 *         title="Longitude",
 *         type="float",
 *         example="24.025217470271",
 *     ),
 * ),
 */
class TourLandingResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslations('title'),
            'description' => $this->getTranslations('description'),
            'lat' => $this->lat,
            'lng' => $this->lng,
        ];
    }
}
