<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\TourFullResource;
use App\Http\Resources\TourShortCollection;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * @OA\Tag(name="Tours", description="Тури")
 */
class TourController extends BaseController
{

    /**
     * @OA\Get (
     *     tags={"Tours"},
     *     path="/tours",
     *     summary="Список туров разбитый на страницы",
     *     @OA\Parameter(
     *         description="Токен авторизації",
     *         in="query",
     *         name="token",
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="request", value="305cc08cecd29d7078a924c8d0eca58b", summary="Тестовий токен"),
     *         @OA\Examples(example="empty", value="", summary="Авторизація за допомогою headers"),
     *     ),
     *     @OA\Parameter(
     *         description="Список id турів розділених комою",
     *         in="query",
     *         name="ids",
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="empty", value="", summary="Будь які турb"),
     *         @OA\Examples(example="request", value="1,2,3,4,5", summary="Тільки тури з обраними ID"),
     *     ),
     *     @OA\Parameter(
     *         description="Список id місць розділених комою",
     *         in="query",
     *         name="places",
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="empty", value="", summary="Будь які місця"),
     *         @OA\Examples(example="request", value="2,3,4", summary="Тільки тури з обраними ID "),
     *     ),
     *     @OA\Parameter(
     *         description="Сторінка",
     *         in="query",
     *         name="page",
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="empty", value="", summary="За замовчуванням (1)"),
     *         @OA\Examples(example="request", value="2", summary="Друга сторінка"),
     *     ),
     *     @OA\Parameter(
     *         description="Турів на сторінку",
     *         in="query",
     *         name="per_page",
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="empty", value="", summary="За замовчуванням (12)"),
     *         @OA\Examples(example="request", value="10", summary="10 штук"),
     *     ),
     *     @OA\Parameter(
     *         description="Ціна, з",
     *         in="query",
     *         name="price_from",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Parameter(
     *         description="Ціна, до",
     *         in="query",
     *         name="price_to",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Parameter(
     *         description="Пошук по тексту",
     *         in="query",
     *         name="q",
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             oneOf={
     *                 @OA\Schema(ref="#/components/schemas/PaginageTourResult"),
     *             },
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $tours = Tour::search()->filter($request->all())->paginate($request->input('per_page', 12));
        return new TourShortCollection($tours);
    }


    /**
     * @OA\Get(
     *     tags={"Tours"},
     *     path="/tour/{id}",
     *     summary="Подробная информация о туре",
     *     @OA\Parameter(
     *         description="Токен авторизації",
     *         in="query",
     *         name="token",
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="request", value="305cc08cecd29d7078a924c8d0eca58b", summary="Тестовий токен"),
     *         @OA\Examples(example="empty", value="", summary="Авторизація за допомогою headers"),
     *     ),
     *     @OA\Parameter(
     *         description="ID туру",
     *         in="path",
     *         name="id",
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="empty", value="13", summary="Замки Львівщини + Замок Мушкетерів"),
     *         @OA\Examples(example="request", value="48", summary="10 родзинок Закарпаття"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="ОК",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/TourDetails"),
     *            )
     *         )
     *     )
     * )
     */
    public function details(Tour $tour)
    {

        $tour->load([
            'scheduleItems' => function ($sc) {
                return $sc->whereDate('tour_schedules.start_date', '>=', Carbon::now());
            },
            'badges',
            'directions',
            'subjects',
            'types',
            'media',
            'places',
            'places.media',
            'places.country',
            'places.region',
            'places.district',
            'places.city',
            'places.direction',
            'tourIncludes',
            'tourIncludes.type',
            'tourIncludes.finance',
            'planItems',
            'foodItems',
            'foodItems.food',
            'foodItems.food.media',
            'foodItems.time',
            'tourAccommodations',
            'tourAccommodations.accommodation',
            'tourAccommodations.accommodation.media',
            'tickets' => function ($q) {
                return $q->orderBy('position');
            },
            'discounts',
            'landings',
            'media',
        ]);
        return new TourFullResource($tour);
    }
}
