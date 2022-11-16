<?php

namespace App\Lib\Bitrix24\Core;

class BaseService
{
    protected $baseMethod;

    protected $additionalParams = [];


    public function __construct($baseMethod, $additionalParams = [])
    {
        $this->baseMethod = rtrim($baseMethod, ".");
        $this->additionalParams = $additionalParams;
    }

    /**
     * Возвращает описание полей, в том числе пользовательских
     *
     * @return BitrixResponse
     */
    public function fields($params = [])
    {
        $params = array_merge($this->getAdditionalParams(), $params);
        return Client::call($this->baseMethod . '.fields', $params);
    }


    /**
     * Возвращает список сущностей по фильтру.
     *
     * @param array $select Список возвращаемых полей
     * @param array $filter Фильтр
     * @param array $order Сортировка
     * @return BitrixResponse
     */
    public function list($select = ['*', 'UF_*'], $filter = [], $order = [], $start = null)
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

        $params = array_merge($this->getAdditionalParams(), $params);
        return Client::call($this->baseMethod . '.list', $params);
    }

    /**
     * Создаёт новую сущность.
     *
     * @param array $fields Набор полей - массив вида array("поле"=>"значение"[, ...]), содержащий значения полей сущности.
     * @param array $params Набор параметров. REGISTER_SONET_EVENT => Y  - произвести регистрацию события добавления сущности в живой ленте.
     * @return BitrixResponse
     */
    public function add($fields, $params = [])
    {
        $data = array_merge($this->getAdditionalParams(), [
            'fields' => $fields,
            'params' => $params,
        ]);

        return Client::call($this->baseMethod . '.add', $data);
    }

    /**
     * Возвращает сущность по идентификатору.
     *
     * @param string $id Идентификатор сущности.
     * @return BitrixResponse
     */
    public function get($id, $params = [])
    {
        $params = array_merge($this->getAdditionalParams(), $params, ['id' => $id]);
        return Client::call($this->baseMethod . '.get', $params);
    }


    /**
     * Обновляет существующую сущность.
     *
     * @param string $id Идентификатор сущности.
     * @param array $fields Набор полей - массив вида array("поле"=>"значение"[, ...]), содержащий значения полей сущности.
     * @param array $params Набор параметров. REGISTER_SONET_EVENT => Y - произвести регистрацию события добавления лида в живой сущности.
     * @return BitrixResponse
     */
    public function update($id, $fields, $params = [])
    {
        $data = array_merge($this->getAdditionalParams(), [
            'id' => $id,
            'fields' => $fields,
            'params' => $params,
        ]);

        return Client::call($this->baseMethod . '.update', $data);
    }

    /**
     * Дополнительные параметры передаваемые на сервер
     * @return array
     */
    public function getAdditionalParams()
    {
        return $this->additionalParams ?? [];
    }

    /**
     * Дополнительные параметры передаваемые на сервер
     */
    public function setAdditionalParams($params = [])
    {
        $this->additionalParams = $params;
    }
}
