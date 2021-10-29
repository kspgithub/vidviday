<?php

namespace App\Lib\Bitrix24\Core;

use App\Lib\Bitrix24\CRM\Contact\ContactService;

trait UseStaticService
{

    /**
     * @var StaticServiceInterface
     */
    protected static $instance;

    /**
     * @var BaseService
     */
    public $service;


    public function __construct($baseUrl)
    {
        $this->service = new BaseService($baseUrl);
    }

    public static function instance()
    {
        if (!self::$instance) {
            self::$instance = new self(self::apiBaseMethod());
        }
        return self::$instance;
    }

    /**
     * Возвращает описание полей сущности, в том числе пользовательских
     *
     * @return BitrixResponse
     */
    public static function fields()
    {
        return self::instance()->service->fields();
    }


    /**
     * Возвращает список сущностей по фильтру.
     *
     * @param array $select Список возвращаемых полей
     * @param array $filter Фильтр
     * @param array $order Сортировка
     * @return BitrixResponse
     */
    public static function list(array $select = ['*', 'UF_*'], array $filter = [], array $order = [], $start = null)
    {
        return self::instance()->service->list($select, $filter, $order, $start);
    }

    /**
     * Возвращает сущность по идентификатору.
     *
     * @param string|int $id Идентификатор сущности.
     * @return BitrixResponse
     */
    public static function get($id)
    {
        return self::instance()->service->get($id);
    }


    /**
     * Создаёт новую сущность.
     *
     * @param array $fields Набор полей - массив вида array("поле"=>"значение"[, ...]), содержащий значения полей лида.
     * @param array $params Набор параметров. REGISTER_SONET_EVENT =>Y - произвести регистрацию события добавления лида в живой ленте.
     * @return BitrixResponse
     */
    public static function add(array $fields, array $params = [])
    {
        return self::instance()->service->add($fields, $params);
    }


    /**
     * Обновляет существующую сущность.
     *
     * @param string $id Идентификатор сущности.
     * @param array $fields Набор полей - массив вида array("поле"=>"значение"[, ...]), содержащий значения полей лида.
     * @param array $params Набор параметров.
     * @return BitrixResponse
     */
    public static function update($id, $fields, $params = [])
    {
        return self::instance()->service->update($id, $fields, $params);
    }
}
