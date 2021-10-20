<?php

namespace App\Lib\Bitrix24\CRM;

use App\Lib\Bitrix24\Core\Client;

/**
 * Справка https://dev.1c-bitrix.ru/rest_help/crm/leads/index.php
 */
class LeadService
{
    /**
     * Возвращает описание полей лида, в том числе пользовательских
     * https://dev.1c-bitrix.ru/rest_help/crm/leads/crm_lead_fields.php
     *
     * @return mixed
     */
    public static function fields()
    {
        return Client::get('crm.lead.fields');
    }

    /**
     * Создаёт новый лид.
     * https://dev.1c-bitrix.ru/rest_help/crm/leads/crm_lead_add.php
     *
     * @param array $fields Набор полей - массив вида array("поле"=>"значение"[, ...]), содержащий значения полей лида.
     * @param array $params Набор параметров. REGISTER_SONET_EVENT - произвести регистрацию события добавления лида в живой ленте. Дополнительно будет отправлено уведомление ответственному за лид.
     * @return mixed
     */
    public static function add($fields, $params = ['REGISTER_SONET_EVENT' => 'Y'])
    {
        return Client::post('crm.lead.add', [
            'fields' => $fields,
            'params' => $params,
        ]);
    }

    /**
     * Возвращает список лидов по фильтру.
     * https://dev.1c-bitrix.ru/rest_help/crm/leads/crm_lead_list.php
     *
     * @param array $select Список возвращаемых полей
     * @param array $filter Фильтр
     * @param array $order Сортировка
     * @return mixed
     */
    public static function list($select = ['*', 'UF_'], $filter = [], $order = [])
    {
        $params = ['select' => $select];
        if (!empty($filter)) {
            $params['filter'] = $filter;
        }
        if (!empty($order)) {
            $params['order'] = $order;
        }
        return Client::get('crm.lead.list', $params);
    }

    /**
     * Возвращает лид по идентификатору.
     *
     * @param string $id Идентификатор лида.
     * @return mixed
     */
    public static function get($id)
    {
        return Client::get('crm.lead.get', ['id' => $id]);
    }

    /**
     * Обновляет существующий лид.
     * https://dev.1c-bitrix.ru/rest_help/crm/leads/crm_lead_update.php
     *
     * @param string $id Идентификатор лида.
     * @param array $fields Набор полей - массив вида array("поле"=>"значение"[, ...]), содержащий значения полей лида.
     * @param array $params Набор параметров. REGISTER_SONET_EVENT - произвести регистрацию события добавления лида в живой ленте. Дополнительно будет отправлено уведомление ответственному за лид.
     * @return mixed
     */
    public static function update($id, $fields, $params = ['REGISTER_SONET_EVENT' => 'Y'])
    {
        return Client::post('crm.lead.update', [
            'id' => $id,
            'fields' => $fields,
            'params' => $params,
        ]);
    }
}
