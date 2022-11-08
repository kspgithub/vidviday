<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @mixin \App\Models\Tour
 *
 * @OA\Schema(
 *     schema="Badge",
 *     type="object",
 *     description="Мітка",
 *     @OA\Property(
 *         property="title",
 *         title="Назва туру",
 *         type="object",
 *         example={"uk": "Бестселер", "en": "Bestseller", "ru": "Бестселлер",  "pl": "Bestseller" }
 *     ),
 *     @OA\Property(
 *         property="color",
 *         title="Колір",
 *         type="string",
 *         example="#ffb947"
 *     ),
 *     @OA\Property(
 *         property="slug",
 *         title="English",
 *         type="string",
 *         example="bestseler"
 *     ),
 * ),
 *
 * @OA\Schema(
 *     schema="Tour",
 *     type="object",
 *     description="Картка туру",
 *     @OA\Property(
 *         property="id",
 *         title="ID туру",
 *         example="48",
 *         type="integer",
 *     ),
 *     @OA\Property(
 *         property="title",
 *         title="Назва туру",
 *         type="object",
 *         example={"uk": "10 родзинок Закарпаття", "en": "10 highlights of Transcarpathia", "ru": "10 изюминок Закарпатья",  "pl": "10 Rodzynki Zakarpacia" }
 *     ),
 *     @OA\Property(
 *         property="locales",
 *         title="Мови туру",
 *         type="array",
 *         @OA\Items( type="string", example="uk")
 *     ),
 *     @OA\Property(
 *         property="duration_format",
 *         title="Формат тривалості",
 *         description="0 - дні/ночи, 1 - години",
 *         type="integer",
 *         example="0",
 *     ),
 *     @OA\Property(
 *         property="duration",
 *         title="Тривалість днів",
 *         type="integer",
 *         example="3",
 *     ),
 *     @OA\Property(
 *         property="nights",
 *         title="Тривалість ночей",
 *         type="integer",
 *         example="2",
 *     ),
 *     @OA\Property(
 *         property="time",
 *         title="Тривалість годин",
 *         type="integer",
 *         example="null",
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
 *         property="rating",
 *         title="Рейтинг туру",
 *         type="float",
 *         example="4.8",
 *     ),
 *     @OA\Property(
 *         property="video",
 *         title="Відео туру",
 *         type="string",
 *         example="https://youtu.be/4-9h76MqT3c",
 *     ),
 *     @OA\Property(
 *         property="main_image",
 *         title="Головне зображення",
 *         type="string",
 *         example="http://vidviday.loc/storage/media/tour/3758/conversions/mukachevo-zamok-palanok-yuriy-krylivets-thumb.jpg",
 *     ),
 *     @OA\Property(
 *         property="thumb",
 *         title="Превью",
 *         type="string",
 *         example="http://vidviday.loc/storage/media/tour/3759/mukachevo-zamok-palanok-yuriy-krylivets-1x1.jpg",
 *     ),
 *     @OA\Property(
 *         property="badges",
 *         title="Мітки туру",
 *         type="array",
 *         @OA\Items( ref="#/components/schemas/Badge")
 *     ),
 *     @OA\Property(
 *         property="schedules",
 *         title="Дати виїзду",
 *         type="array",
 *         @OA\Items( ref="#/components/schemas/Schedule")
 *     ),
 * ),
 *
 */
class TourShortResource extends JsonResource
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
            'locales' => $this->locales,
            'duration_format' => $this->duration_format,
            'duration' => $this->duration,
            'nights' => $this->nights,
            'time' => $this->time,
            'price' => $this->price,
            'accommodation_price' => $this->accomm_price,
            'currency' => $this->currency,
            'rating' => $this->rating,
            'video' => $this->video,
            'main_image' => $this->main_image,
            'thumb' => $this->mobile_image,
            'dimensions' => $this->dimensions,
            'badges' => $this->badges,
            'schedules' => ScheduleResource::collection($this->scheduleItems)
        ];
    }
}
