<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Partner;

/**
 * @OA\Server(
 *      url="/api/v1",
 * )
 *
 * @OA\Info(
 *      title="Єкспорт турів",
 *      version="1.0.0",
 * )
 *
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      description="305cc08cecd29d7078a924c8d0eca58b",
 * ),
 *
 * @OA\Schema(
 *     schema="PaginationLink",
 *     type="object",
 *     @OA\Property(
 *         property="url",
 *         title="URL",
 *         type="string",
 *         example="https://vidviday.ua/api/v1/tours?page=1"
 *     ),
 *     @OA\Property(
 *         property="label",
 *         title="Label",
 *         type="string",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="active",
 *         title="Active",
 *         type="boolean",
 *         example=true
 *     ),
 * ),
 *
 * @OA\Schema(
 *     schema="PaginationLinks",
 *     type="object",
 *     @OA\Property(
 *         property="first",
 *         description="Перша сторінка",
 *         type="string",
 *     ),
 *     @OA\Property(
 *         property="last",
 *         description="Остання сторінка",
 *         type="string",
 *     ),
 *     @OA\Property(
 *         property="prev",
 *         description="Попередня сторінка",
 *         type="string",
 *     ),
 *     @OA\Property(
 *         property="next",
 *         description="Наступна сторінка",
 *         type="string",
 *     ),
 * ),
 *
 * @OA\Schema(
 *     schema="PaginationMeta",
 *     type="object",
 *     @OA\Property(
 *         property="current_page",
 *         title="Поточна сторінка",
 *         type="integer",
 *         example="1",
 *     ),
 *     @OA\Property(
 *         property="from",
 *         title="Показано з",
 *         type="integer",
 *         example="1",
 *     ),
 *     @OA\Property(
 *         property="to",
 *         title="Показано по",
 *         type="integer",
 *         example="12"
 *     ),
 *     @OA\Property(
 *         property="last_page",
 *         title="Остання сторінка",
 *         type="integer",
 *         example="3",
 *     ),
 *     @OA\Property(
 *         property="links",
 *         title="Посилання на сторінки",
 *         type="array",
 *         @OA\Items( ref="#/components/schemas/PaginationLink")
 *     ),
 *     @OA\Property(
 *         property="path",
 *         title="Path",
 *         type="string",
 *         example="https://vidviday.ua/api/v1/tours"
 *     ),
 *     @OA\Property(
 *         property="per_page",
 *         title="Кількість обїектів на сторінці",
 *         type="integer",
 *         example="12"
 *     ),
 *     @OA\Property(
 *         property="total",
 *         title="Усього об'єктів",
 *         type="integer",
 *         example="25"
 *     ),
 * ),
 *
 * @OA\Schema(
 *     schema="Localize",
 *     type="object",
 *     description="Об'єкт локалізації",
 *     @OA\Property(
 *         property="ru",
 *         description="Русский",
 *         type="string",
 *     ),
 *     @OA\Property(
 *         property="uk",
 *         description="Українська",
 *         type="string",
 *     ),
 *     @OA\Property(
 *         property="en",
 *         description="English",
 *         type="string",
 *     ),
 *     @OA\Property(
 *         property="pl",
 *         description="Польська",
 *         type="string",
 *     ),
 * ),
 */
class BaseController extends Controller
{
    protected $partner;

    public function __construct()
    {
        $this->partner = Partner::where('token', request()->input('token', request()->bearerToken()))->first();
    }
}
