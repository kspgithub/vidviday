<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\TourAccommodation
 *
 * @OA\Schema(
 *     schema="TourAccommodation",
 *     type="object",
 *     description="Розміщення туру",
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
 *         example= { "uk": "Готель у с. Поляниця на курорті Буковель", "ru": "Гостиница в с. Поляница (на курорте Буковель)", "en": "Hotel in the Polyanytsa village (resort Bukovel)", "pl": "Hotel we wsi Polanica (w miejscowości Bukowel)" }
 *     ),
 *     @OA\Property(
 *         property="text",
 *         title="Текст",
 *         type="object",
 *         example={ "uk": "", "ru": "", "en": "", "pl": "" }
 *     ),
 *     @OA\Property(
 *         property="images",
 *         title="Зображення",
 *         type="array",
 *         @OA\Items(    type="string", example="https://vidviday.ua/storage/media/tour/3758/conversions/mukachevo-zamok-palanok-yuriy-krylivets-thumb.jpg",)
 *     ),
 * ),
 */
class TourAccommodationResource extends JsonResource
{
    /**
     * @param Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->accommodation->id,
            'title' => $this->accommodation->getTranslations('title'),
            'text' => $this->accommodation->getTranslations('text'),
            'images' => $this->accommodation->getMedia()->map(fn ($it) => $it->getFullUrl('normal')),
        ];
    }
}
