<?php

namespace App\Lib\Bitrix24\CRM\Lead;

class LeadFields
{
    // Отмечаем если тестируем
    public const FIELD_TEST = 'UF_CRM_60C0BF12E5B07';

    // Основные поля
    public const FIELD_TITLE = 'TITLE'; // Название лида обязательное

    public const FIELD_NAME = 'NAME'; // string Имя, обязательное

    public const FIELD_LAST_NAME = 'LAST_NAME'; // string Фамилия, обязательное

    public const FIELD_EMAIL = 'EMAIL'; // crm_multifield Множественное, передавать как массив

    public const FIELD_PHONE = 'PHONE'; // crm_multifield Множественное, передавать как массив

    public const FIELD_WHATS_APP = 'UF_CRM_1626881622';

    public const FIELD_COMMENTS = 'COMMENTS'; // string Комментарии

    public const FIELD_CONTACT_ID = 'CONTACT_ID'; // Привязка лида к контакту

    // UTM метки
    public const FIELD_UTM_CAMPAIGN = 'UTM_CAMPAIGN'; // Обозначение рекламной кампании

    public const FIELD_UTM_CONTENT = 'UTM_CONTENT'; // Содержание кампании

    public const FIELD_UTM_MEDIUM = 'UTM_MEDIUM'; // Тип трафика

    public const FIELD_UTM_SOURCE = 'UTM_SOURCE'; // Тип трафика

    public const FIELD_UTM_TERM = 'UTM_TERM'; // 	Рекламная система
}
