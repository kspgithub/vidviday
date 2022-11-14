<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @see \App\Models\Tour
 *
 * @OA\Schema(
 *     schema="PaginageTourResult",
 *     type="object",
 *     description="Посторінкове виведення турів",
 *     @OA\Property(
 *         property="data",
 *         description="Массив Турів",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Tour")
 *     ),
 *     @OA\Property(
 *         property="links",
 *         description="Проста пагінація",
 *         type="object",
 *         ref="#/components/schemas/PaginationLinks",
 *     ),
 *     @OA\Property(
 *         property="meta",
 *         description="Мета інформація",
 *         type="object",
 *         ref="#/components/schemas/PaginationMeta",
 *     ),
 * ),
 */
class TourShortCollection extends ResourceCollection
{
    /**
     * @param Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
