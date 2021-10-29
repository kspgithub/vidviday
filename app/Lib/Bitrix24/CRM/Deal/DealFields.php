<?php

namespace App\Lib\Bitrix24\CRM\Deal;

use App\Models\Order;

class DealFields
{
    // Отмечаем если тестируем
    public const FIELD_TEST = 'UF_CRM_60C0BF12E5B07';

    // ID
    public const FIELD_ID = 'ID';

    // Этап сделки
    public const FIELD_STAGE_ID = 'STAGE_ID';

    // Название сделки
    public const FIELD_TITLE = 'TITLE';

    // ID Категории
    public const FIELD_CATEGORY_ID = 'CATEGORY_ID';

    // ID Контакта
    public const FIELD_CONTACT_ID = 'CONTACT_ID';

    // Коментар
    public const FIELD_COMMENTS = 'COMMENTS';

    // Сумма к оплате
    public const FIELD_TOTAL_AMOUNT = 'OPPORTUNITY';

    // Валюта
    public const FIELD_CURRENCY = 'CURRENCY_ID';

    // Дата початку
    public const FIELD_BEGIN_DATE = 'BEGINDATE';

    // Дата завершення
    public const FIELD_CLOSE_DATE = 'CLOSEDATE';

    // [ТУР]: Тип групи
    public const FIELD_GROUP_TYPE = 'UF_CRM_60D5C28BF143C';

    public const GROUP_TYPE_VALUES = [
        Order::GROUP_TEAM => '249', // Збірна група
        Order::GROUP_CORPORATE => '251', // Корпоративна група
    ];

    // [ТУР]: Назва туру (массив ID в crm)
    public const FIELD_TOUR_ID = 'UF_CRM_6173337A7927C';

    // [ТУР]: Напрямок туру для виїзду (ID тура в CRM)
    public const FIELD_SCHEDULE_TOUR_ID = 'UF_CRM_60EE865DE0C35';

    // [ТУР] Обраний по датам виїзд туру
    public const FIELD_SCHEDULE_ID = 'UF_CRM_1634979354';

    // [ТУР] Комиссия агента
    public const FIELD_COMMISSION = 'UF_CRM_1635318476';

    // [ТУР]: Дата виїзду
    public const FIELD_START_DATE = 'UF_CRM_60D5C28C0F9D2';

    // [ТУР]: Дата повернення
    public const FIELD_END_DATE = 'UF_CRM_60D5C28C1CBF5';

    // [ТУР] Дата завершення туру
    public const FIELD_SCHEDULE_END_DATE = 'UF_CRM_60D5C28BABC0F';

    // [ТУР] Тривалість днів
    public const FIELD_DURATION = 'UF_CRM_60D5C28BA1902';

    // [ТУР]: Кількість осіб (заказ)
    public const FIELD_PLACES = 'UF_CRM_60D5C28C29237';

    // [ТУР] Місць вільних (расписание)
    public const FIELD_SCHEDULE_PLACES = 'UF_CRM_1635016202';

    // [ТУР]: Кількість осіб (расписание)
    public const FIELD_PLACES_BOOKED = 'UF_CRM_60D5C28C29237';

    // [ТУР] Примітки
    public const FIELD_SCHEDULE_COMMENT = 'UF_CRM_60D5C28BBBD28';

    // [ТУР]: Плануєте взяти дітей
    public const FIELD_CHILDREN = 'UF_CRM_60D5C28C374B7';

    // [ТУР]: Діти до 6 років
    public const FIELD_CHILDREN_YOUNG = 'UF_CRM_60D5C28C43A3F';

    // [ТУР]: Діти від 6 до 12 років
    public const FIELD_CHILDREN_OLDER = 'UF_CRM_60D5C28C517FB';

    // [ТУР]: Участники туру
    public const FIELD_PARTICIPANTS_COMMENT = 'UF_CRM_60D5C28BC7792';

    // [ТУР] Як ви бажаєте отримати підтвердження?
    public const FIELD_CONFIRMATION_TYPE = 'UF_CRM_60D5C28B77EFA';

    // [ТУР] Як ви бажаєте отримати підтвердження? (Значения)
    public const CONFIRMATION_VALUES = [
        Order::CONFIRMATION_EMAIL => '219', // Email
        Order::CONFIRMATION_VIBER => '221', // Viber
        Order::CONFIRMATION_PHONE => '223', // PHONE
    ];

    // [ТУР] Як ви бажаєте отримати підтвердження? (Названия)
    public const CONFIRMATION_NAMES = [
        Order::CONFIRMATION_EMAIL => 'Email', // Email
        Order::CONFIRMATION_VIBER => 'Viber', // Viber
        Order::CONFIRMATION_PHONE => 'Телефон', // PHONE
    ];

    // Проживание сопоставление, передаем число
    public const ACCOMMODATION_FIELDS_COMPARISON = [
        '1о_plus' => 'UF_CRM_60D5C28C603C7', // '[ПОСЕЛЕННЯ]: 1о+',
        '1о_sgl' => 'UF_CRM_60D5C28C6D8B7', // '[ПОСЕЛЕННЯ]: 1o / SGL',
        '2о_twn' => 'UF_CRM_60D5C28C78E96', // '[ПОСЕЛЕННЯ]: 2o / TWN',
        '2p_dbl' => 'UF_CRM_60D5C28C8732D', // '[ПОСЕЛЕННЯ]: 2p / DBL',
        '3о_trpl' => 'UF_CRM_60D5C28C97952', // '[ПОСЕЛЕННЯ]: 3о / TRPL',
        '2р_1о_trpl' => 'UF_CRM_60D5C28CB1677', // '[ПОСЕЛЕННЯ]: 2р+1о / TRPL',
        '4о_qdpl' => 'UF_CRM_60D5C28CBD992', // '[ПОСЕЛЕННЯ]: 4о / QDPL',
        '2р_2р_qdpl' => 'UF_CRM_60D5C28CCC155', // '[ПОСЕЛЕННЯ]: 2р+2р / QDPL',
        'other' => 'UF_CRM_1635146128', // '[ПОСЕЛЕННЯ]: інше',
    ];

    // [ОПЛАТА]: Сума без знижки
    public const FIELD_PRICE = 'UF_CRM_1635010247';

    // [ОПЛАТА]: Сума знижки
    public const FIELD_DISCOUNT = 'UF_CRM_1635411345';

    // [ОПЛАТА]: Форма оплати
    public const FIELD_PAYMENT_TYPE = 'UF_CRM_60D5C28CE2CC8';

    // [ОПЛАТА]: Форма оплати (значения)
    public const PAYMENT_TYPE_VALUES = [
        1 => "253", // За банківськими реквізитами (для звичайних фізичних осіб)
        2 => "255", // За банківськими реквізитами (для ФОП та юридичних осіб, які є платниками єдиного податку)
        3 => "257", // За банківськими реквізитами (для ФОП та юридичних осіб, які не є платниками єдиного податку)
        4 => "259", // Оплата в офісі
        5 => "261", // Онлайн-оплата (LiqPay)
    ];

    // [ОПЛАТА]: Чи потрібен АКТ?
    public const FIELD_ACT = 'UF_CRM_60FE739D97FD6';


    // [ОПЛАТА]: Чи потрібен АКТ?  (значения)
    public const ACT_VALUES_COMPARISON = [
        0 => '716', // ні
        1 => '714', // так
    ];

    // [ОПЛАТА]: Примітки
    public const FIELD_PAYMENT_COMMENT = 'UF_CRM_1635415194';
}
