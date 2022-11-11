<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Tour
 *
 * @OA\Schema(
 *     schema="TourDetails",
 *     type="object",
 *     description="Детальна інформація про тур",
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
 *         example={"uk": "10 родзинок Закарпаття", "en": "10 highlights of Transcarpathia", "ru": "10 изюминок Закарпатья",  "pl": "10 Rodzynki Zakarpacia" },
 *     ),
 *     @OA\Property(
 *         property="text",
 *         title="Опис туру",
 *         type="object",
 *         example={"uk": "10 родзинок Закарпаття, опис", "en": "10 highlights of Transcarpathia", "ru": "10 изюминок Закарпатья",  "pl": "10 Rodzynki Zakarpacia" }
 *     ),
 *     @OA\Property(
 *         property="additional_info",
 *         title="Додаткова інформація",
 *         type="object",
 *         example={ "title": { "en": "New Year's fun", "pl": "Noworoczna zabawa", "ru": "Новогодняя забава", "uk": "Новорічна забава" }, "text": { "uk": "<p>-</p>", "ru": "<p>-</p>", "en": "<p>-</p>", "pl": "<p>-</p>" } },
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
 *         property="currency",
 *         title="Валюта",
 *         type="string",
 *         example="UAH",
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
 *         property="images",
 *         title="Додаткові зображення",
 *         type="array",
 *         @OA\Items( type="string", example="http://vidviday.loc/storage/media/tour/3758/conversions/mukachevo-zamok-palanok-yuriy-krylivets-thumb.jpg",)
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
 *     @OA\Property(
 *         property="directions",
 *         title="Напрямки",
 *         type="array",
 *         @OA\Items( type="object", example={"title": {"uk": "Карпати"}}),
 *     ),
 *     @OA\Property(
 *         property="types",
 *         title="Типи",
 *         type="array",
 *         @OA\Items( type="object", example={"title": {"uk": "Походи в гори"}}),
 *     ),
 *     @OA\Property(
 *         property="places",
 *         title="Місця",
 *         type="array",
 *         @OA\Items( ref="#/components/schemas/Place"),
 *     ),
 *     @OA\Property(
 *         property="includes",
 *         title="Зміст туру",
 *         type="array",
 *         @OA\Items( ref="#/components/schemas/TourInclude"),
 *     ),
 *     @OA\Property(
 *         property="plan",
 *         title="План туру",
 *         type="object",
 *         example={"uk": "<p><strong>1 день:</strong> виїзд зі Львова (08:00)", "en": "<p><strong>Day 1:</strong> departure from Lviv (08:00 a.m.)", "ru": "<p><strong>1 день: </strong>выезд со Львова (08:00)",  "pl": "<p>none</p>" }
 *     ),
 *     @OA\Property(
 *         property="food",
 *         title="Харчування",
 *         type="array",
 *         @OA\Items( ref="#/components/schemas/TourFood"),
 *     ),
 *     @OA\Property(
 *         property="accommodation",
 *         title="Розміщення",
 *         type="array",
 *         @OA\Items( ref="#/components/schemas/TourAccommodation"),
 *     ),
 *     @OA\Property(
 *         property="tickets",
 *         title="Квитки",
 *         type="array",
 *         @OA\Items( ref="#/components/schemas/TourTicket"),
 *     ),
 *     @OA\Property(
 *         property="discounts",
 *         title="Знижки",
 *         type="array",
 *         @OA\Items( ref="#/components/schemas/TourDiscount"),
 *     ),
 *     @OA\Property(
 *         property="landings",
 *         title="Місця посадки",
 *         type="array",
 *         @OA\Items( ref="#/components/schemas/TourLanding"),
 *     ),
 * ),
 */
class TourFullResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslations('title'),
            'text' => $this->getTranslations('text'),
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
            'additional_info' => $this->getAdditionalInfoToExport(),
            'main_image' => $this->main_image,
            'thumb' => $this->mobile_image,
            'images' => $this->getImagesToExport(),
            'badges' => $this->badges,
            'schedules' => ScheduleResource::collection($this->scheduleItems),
            'directions' => $this->getDirectionsToExport(),
            //            'subjects' => $this->getSubjectsToExport(),
            'types' => $this->getTypesToExport(),
            'places' => $this->getPlacesToExport(),
            'includes' => $this->getIncludesToExport(),
            'plan' => $this->getPlanToExport(),
            'food' => $this->getFoodToExport(),
            'accommodation' => $this->getAccommodationToExport(),
            'tickets' => $this->getTicketsToExport(),
            'discounts' => $this->getDiscountsToExport(),
            'landings' => $this->getLandingsToExport(),
        ];
    }
}
