<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Базовый класс для переводимых сущностей
 * Class TranslatableModel
 * @package App\Models
 */
abstract class TranslatableModel extends Model
{


    // фикс сохранение в бд кириллических символов
    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
