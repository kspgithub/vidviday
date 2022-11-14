<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Базовый класс для переводимых сущностей
 * Class TranslatableModel
 */
abstract class TranslatableModel extends Model
{
    // фикс сохранение в бд кириллических символов
    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
