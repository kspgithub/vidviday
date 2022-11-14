<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\TourTicket
 *
 * @OA\Schema(
 *     schema="TourTicket",
 *     type="object",
 *     description="Квитки туру",
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
 *         example={ "uk": "Галицький НПП: музей і Центр реабілітації тварин", "ru": "Галицкий  НПП: музей и центр реабилитации диких животных", "en": "Halych NNP: museum and the Center for the rehabilitation of wild animals" }
 *     ),
 *     @OA\Property(
 *         property="text",
 *         title="Текст",
 *         type="object",
 *         example={ "uk": "", "ru": "", "en": "", "pl": "" }
 *     ),
 *     @OA\Property(
 *         property="currency",
 *         title="Валюта",
 *         type="string",
 *         example="UAH",
 *     ),
 *     @OA\Property(
 *         property="price",
 *         title="Вартість",
 *         type="integer",
 *         example="50",
 *     ),
 * ),
 */
class TourTicketResource extends JsonResource
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
            'text' => $this->getTranslations('text'),
            'price' => $this->price,
            'currency' => $this->currency,
        ];
    }
}
