<?php

namespace App\Lib\Bitrix24\Core;

class BaseService
{
    protected $baseMethod;

    public function __construct($baseMethod)
    {
        $this->baseMethod = rtrim($baseMethod, ".");
    }

    /**
     * Возвращает описание полей, в том числе пользовательских
     *
     * @return mixed
     */
    public function fields()
    {
        return Client::get($this->baseMethod . '.fields');
    }


    /**
     * Возвращает список сущностей по фильтру.
     *
     * @param array $select Список возвращаемых полей
     * @param array $filter Фильтр
     * @param array $order Сортировка
     * @return mixed
     */
    public function list($select = ['*', 'UF_'], $filter = [], $order = [], $start = null)
    {
        $params = ['select' => $select];
        if (!empty($filter)) {
            $params['filter'] = $filter;
        }
        if (!empty($order)) {
            $params['order'] = $order;
        }

        if (!empty($start)) {
            $params['start'] = $start;
        }

        return Client::get($this->baseMethod . '.list', $params);
    }

    /**
     * Создаёт новую сущность.
     *
     * @param array $fields Набор полей - массив вида array("поле"=>"значение"[, ...]), содержащий значения полей сущности.
     * @param array $params Набор параметров. REGISTER_SONET_EVENT => Y  - произвести регистрацию события добавления сущности в живой ленте.
     * @return mixed
     */
    public function add($fields, $params = [])
    {
        return Client::post($this->baseMethod . '.add', [
            'fields' => $fields,
            'params' => $params,
        ]);
    }

    /**
     * Возвращает сущность по идентификатору.
     *
     * @param string $id Идентификатор сущности.
     * @return mixed
     */
    public function get($id)
    {
        return Client::get($this->baseMethod . '.get', ['id' => $id]);
    }


    /**
     * Обновляет существующую сущность.
     *
     * @param string $id Идентификатор сущности.
     * @param array $fields Набор полей - массив вида array("поле"=>"значение"[, ...]), содержащий значения полей сущности.
     * @param array $params Набор параметров. REGISTER_SONET_EVENT => Y - произвести регистрацию события добавления лида в живой сущности.
     * @return mixed
     */
    public function update($id, $fields, $params = [])
    {
        return Client::post($this->baseMethod . '.update', [
            'id' => $id,
            'fields' => $fields,
            'params' => $params,
        ]);
    }
}
