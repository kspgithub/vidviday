<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Place
 *
 * @OA\Schema(
 *     schema="Place",
 *     type="object",
 *     description="Місце",
 *     @OA\Property(
 *         property="id",
 *         title="ID місця",
 *         example="48",
 *         type="integer",
 *     ),
 *     @OA\Property(
 *         property="title",
 *         title="Назва місця",
 *         type="object",
 *         example={"uk": "Галицький національний природний парк", "en": "Halych National Nature Park", "ru": "Галицкий НПП",  "pl": "Halych National Nature Park" }
 *     ),
 *     @OA\Property(
 *         property="text",
 *         title="Опис місця",
 *         type="object",
 *         example={"uk": "10 родзинок Закарпаття, опис", "en": "10 highlights of Transcarpathia", "ru": "10 изюминок Закарпатья",  "pl": "10 Rodzynki Zakarpacia" }
 *     ),
 *     @OA\Property(
 *         property="rating",
 *         title="Рейтинг",
 *         type="float",
 *         example="4.8",
 *     ),
 *     @OA\Property(
 *         property="video",
 *         title="Відео",
 *         type="string",
 *         example="https://youtu.be/4-9h76MqT3c",
 *     ),
 *     @OA\Property(
 *         property="lat",
 *         title="Lattitude",
 *         type="float",
 *         example="49.125078547515",
 *     ),
 *     @OA\Property(
 *         property="lng",
 *         title="Longitude",
 *         type="float",
 *         example="24.724990711236",
 *     ),
 *     @OA\Property(
 *         property="images",
 *         title="Зображення",
 *         type="array",
 *         @OA\Items(    type="string", example="https://vidviday.ua/storage/media/place/2146/1618995966607feafe68ad8-1200x1200.jpg")
 *     ),
 *     @OA\Property(
 *         property="country",
 *         title="Країна",
 *         type="object",
 *         example={"uk":"Україна","ru":"Украина","en":"Ukraine","pl": "Ukraina", },
 *     ),
 *     @OA\Property(
 *         property="region",
 *         title="Область",
 *         type="object",
 *         example={ "uk": "Івано-Франківська область" }
 *     ),
 *     @OA\Property(
 *         property="district",
 *         title="Район",
 *         type="object",
 *         example={ "uk": "Галицький" }
 *     ),
 *     @OA\Property(
 *         property="city",
 *         title="Населений пункт",
 *         type="object",
 *         example={ "uk": "Галич" }
 *     ),
 *     @OA\Property(
 *         property="direction",
 *         title="Напрямок",
 *         type="object",
 *         example={ "uk": "Франківщина" }
 *     ),
 * ),
 */
class PlaceResource extends JsonResource
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
            'title' => $this->title,
            'seo_h1' => $this->seo_h1,
            'seo_title' => $this->seo_title,
            'seo_description' => $this->seo_description,
            'seo_keywords' => $this->seo_keywords,
            'seo_text' => $this->seo_text,
            'text' => $this->text,
            'slug' => $this->slug,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'published' => $this->published,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'video' => $this->video,
            'rating' => $this->rating,
            'main_image' => $this->main_image,
            'translations' => $this->translations,
            'url' => $this->url,
            'media_count' => $this->media_count,
            'testimonials_count' => $this->testimonials_count,
            'tours_count' => $this->tours_count,

            'country_id' => $this->country_id,
            'region_id' => $this->region_id,
            'district_id' => $this->district_id,
            'city_id' => $this->city_id,
            'direction_id' => $this->direction_id,

            'tours' => TourShortCollection::collection($this->whenLoaded('tours')),
        ];
    }
}
