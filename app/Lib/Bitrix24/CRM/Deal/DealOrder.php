<?php

namespace App\Lib\Bitrix24\CRM\Deal;

use App\Lib\Bitrix24\CRM\Contact\ContactItem;
use App\Lib\Bitrix24\CRM\Contact\ContactService;
use App\Lib\Bitrix24\CRM\Contact\ContactValue;
use App\Models\BitrixContact;
use App\Models\Order;
use App\Models\Tour;

class DealOrder
{
    // Отмечаем если тестируем
    public const FIELD_TEST = 'UF_CRM_60C0BF12E5B07';

    public const FIELD_CATEGORY_ID = 'CATEGORY_ID';
    public const FIELD_ID = 'ID';
    public const FIELD_TITLE = 'TITLE';
    public const FIELD_CONTACT_ID = 'CONTACT_ID';
    public const FIELD_COMMENTS = 'COMMENTS';

    public const FIELD_PRICE = 'OPPORTUNITY';
    public const FIELD_CURRENCY = 'CURRENCY_ID';

    /**
     * [ТУР]: Тип групи
     */
    public const FIELD_GROUP_TYPE = 'UF_CRM_60D5C28BF143C';

    public const FIELD_GROUP_TYPE_VALUES = [
        Order::GROUP_TEAM => '249', // Збірна група
        Order::GROUP_CORPORATE => '251', // Корпоративна група
    ];

    /**
     * [ТУР]: Назва туру (строка)
     */
    public const FIELD_TOUR_NAME = 'UF_CRM_60D5C28B954D7';

    /**
     * [ТУР]: Назва туру (ID в crm) массив
     */
    public const FIELD_TOUR_ID = 'UF_CRM_6173337A7927C';


    /**
     * [ТУР]: Дата отправления
     */
    public const FIELD_START_DATE = 'UF_CRM_60D5C28C0F9D2';

    /**
     * [ТУР]: Дата возвращения
     */
    public const FIELD_END_DATE = 'UF_CRM_60D5C28C1CBF5';

    /**
     * [ТУР]: Кількість осіб
     */
    public const FIELD_PLACES = 'UF_CRM_60D5C28C29237';

    /**
     * [ТУР]: Плануєте взяти дітей
     */
    public const FIELD_CHILDREN = 'UF_CRM_60D5C28C374B7';


    /**
     * [ТУР]: Діти до 6 років
     */
    public const FIELD_CHILDREN_YOUNG = 'UF_CRM_60D5C28C43A3F';

    /**
     * [ТУР]: Діти від 6 до 12 років
     */
    public const FIELD_CHILDREN_OLDER = 'UF_CRM_60D5C28C517FB';

    /**
     * [ТУР]: Участники туру
     */
    public const FIELD_PARTICIPANTS = 'UF_CRM_60D5C28BC7792';


    // [ТУР] Як ви бажаєте отримати підтвердження?
    public const FIELD_CONFIRMATION_TYPE = 'UF_CRM_60D5C28B77EFA';

    public const FIELD_CONFIRMATION_VALUES = [
        Order::CONFIRMATION_EMAIL => '219', // Email
        Order::CONFIRMATION_VIBER => '221', // Viber
        Order::CONFIRMATION_PHONE => '223', // PHONE
    ];

    public const FIELD_CONFIRMATION_NAMES = [
        Order::CONFIRMATION_EMAIL => 'Email', // Email
        Order::CONFIRMATION_VIBER => 'Viber', // Viber
        Order::CONFIRMATION_PHONE => 'Телефон', // PHONE
    ];

    /**
     * Передаем число
     */
    public const ACCOMMODATION_FIELDS_COMPARISON = [
        '1о_plus' => 'UF_CRM_60D5C28C603C7', // '[ПОСЕЛЕННЯ]: 1о+',
        '1о_sgl' => 'UF_CRM_60D5C28C6D8B7', // '[ПОСЕЛЕННЯ]: 1o / SGL',
        '2о_twn' => 'UF_CRM_60D5C28C78E96', // '[ПОСЕЛЕННЯ]: 2o / TWN',
        '2p_dbl' => 'UF_CRM_60D5C28C8732D', // '[ПОСЕЛЕННЯ]: 2p / DBL',
        '3о_trpl' => 'UF_CRM_60D5C28C97952', // '[ПОСЕЛЕННЯ]: 3о / TRPL',
        '2р_1о_trpl' => 'UF_CRM_60D5C28CB1677', // '[ПОСЕЛЕННЯ]: 2р+1о / TRPL',
        '4о_qdpl' => 'UF_CRM_60D5C28CBD992', // '[ПОСЕЛЕННЯ]: 4о / QDPL',
        '2р_2р_qdpl' => 'UF_CRM_60D5C28CCC155', // '[ПОСЕЛЕННЯ]: 2р+2р / QDPL',
        'other' => 'UF_CRM_1635146128', // Другое, еще не добавили,
    ];

    /**
     *
     */
    public const FIELD_PAYMENT_TYPE = 'UF_CRM_60D5C28CE2CC8';

    public const FIELD_PAYMENT_TYPE_VALUES = [
        1 => "253", // За банківськими реквізитами (для звичайних фізичних осіб)
        2 => "255", // За банківськими реквізитами (для ФОП та юридичних осіб, які є платниками єдиного податку)
        3 => "257", // За банківськими реквізитами (для ФОП та юридичних осіб, які не є платниками єдиного податку)
        4 => "259", // Оплата в офісі
        5 => "261", // Онлайн-оплата (LiqPay)
    ];

    public const FIELD_ACT = 'UF_CRM_60FE739D97FD6'; // [ОПЛАТА]: Чи потрібен АКТ?

    public const ACT_VALUES_COMPARISON = [
        0 => '716', // ні
        1 => '714', // так
    ];

    public static function createOrder(Order $order)
    {
        $is_test = config('services.bitrix24.test');

        $contactData = [
            'name' => $order->first_name,
            'last_name' => $order->last_name,
            'phone' => $order->phone,
            'email' => $order->email,
            'im' => $order->viber,
        ];

        $contactId = ContactService::getContactId($contactData);


        $data = [];

        if ($is_test) {
            $data[self::FIELD_TEST] = true;
        }

        if (!empty($contactId)) {
            $data[self::FIELD_CONTACT_ID] = $contactId;
        }
        $tour = $order->tour_id > 0 ? Tour::withTrashed()->where('id', $order->tour_id)->first() : null;
        $tour->setLocale('uk');

        $data[self::FIELD_CATEGORY_ID] = 5;
        $data[self::FIELD_TITLE] = 'Замовлення туру: ' . (!empty($tour) > 0 ? $tour->title : 'Корпоратив') . ', ID ' . $order->id;
        if (!empty($tour) && (int)$tour->bitrix_id > 0) {
            $data[self::FIELD_TOUR_ID] = [$tour->bitrix_id];
        }

        $data[self::FIELD_GROUP_TYPE] = self::FIELD_GROUP_TYPE_VALUES[$order->group_type];
        $data[self::FIELD_START_DATE] = $order->start_date->format('d.m.Y');
        $data[self::FIELD_PLACES] = $order->places;

        if (!empty($order->end_date)) {
            $data[self::FIELD_END_DATE] = $order->end_date->format('d.m.Y');
        }

        $data[self::FIELD_CHILDREN] = $order->children ? true : false;

        if ($order->children) {
            $data[self::FIELD_CHILDREN_YOUNG] = $order->children_young;
            $data[self::FIELD_CHILDREN_OLDER] = $order->children_older;
        }

        if ($order->price > 0) {
            $data[self::FIELD_PRICE] = $order->price;
            $data[self::FIELD_CURRENCY] = $order->currency;
        }

        $comment = '';

        if ($order->group_type === Order::GROUP_TEAM) {

            if ($order->additional) {
                foreach ($order->accommodation as $key => $quantity) {
                    if ($key !== 'other' && $key !== 'other_text' && (int)$quantity > 0) {
                        $data[self::ACCOMMODATION_FIELDS_COMPARISON[trim($key)]] = (int)$quantity;
                    }
                }
                if (!empty($order->accommodation['other']) && (int)$order->accommodation['other'] === 1 && !empty($order->accommodation['other_text'])) {
                    $data[self::ACCOMMODATION_FIELDS_COMPARISON['other']] = $order->accommodation['other_text'];
                }

                $participants = self::getParticipantsComment($order->participants);
                if (!empty($participants)) {
                    $data[self::FIELD_PARTICIPANTS] = $participants;
                }

            }
        }

        if ($order->group_type === Order::GROUP_CORPORATE) {
            $aboutCorporate = "<br /><div><strong>Інформація про корпоратив:</strong></div><br />";
            $aboutCorporate .= "<div><strong>Місце виїзду:</strong> $order->start_place</div>";
            $aboutCorporate .= "<div><strong>Місце повернення:</strong> $order->end_place</div>";

            if ($order->program_type === Order::PROGRAM_CUSTOM) {
                $aboutCorporate .= "<br /><div><strong>План туру:</strong> $order->tour_plan</div>";
            }

            $data[self::FIELD_START_DATE] = $order->start_date;
            $data[self::FIELD_END_DATE] = $order->end_date;

            $aboutCorporate .= "<br /><div><strong>Особливості групи:</strong> $order->group_comment</div>";
            $aboutCorporate .= "<br /><div><strong>Побажання та умови:</strong> $order->program_comment</div>";
            if (!empty($order->price_include)) {
                $includes = self::getPriceInclude($order->price_include);
                $aboutCorporate .= "<br /><div><strong>Включити у вартість:</strong> $includes</div>";
            }
            if (!empty($order->offer_date)) {
                $offer_date = $order->offer_date->format('d.m.Y');
                $aboutCorporate .= "<br /><div><strong>Надіслати пропозицію до:</strong> $offer_date</div>";
            }


            $comment .= $aboutCorporate;
        }


        if ($order->payment_type > 0) {
            $data[self::FIELD_PAYMENT_TYPE] = self::FIELD_PAYMENT_TYPE_VALUES[$order->payment_type];
        }

        if ($order->confirmation_type > 0) {
            $data[self::FIELD_CONFIRMATION_TYPE] = self::FIELD_CONFIRMATION_VALUES[$order->confirmation_type];
            $confirmation_name = self::FIELD_CONFIRMATION_NAMES[$order->confirmation_type];
            $comment .= "<br /><div><strong>Підтвердити на $confirmation_name:</strong> $order->confirmation_contact</div>";
        }

        if (!empty($order->comment)) {
            $comment .= "<br /><div><strong>Примітки:</strong></div>";
            $comment .= "<div>$order->comment</div>";
            $comment .= "<br />";
        }

        $data[self::FIELD_COMMENTS] = $comment;


        $response = DealService::add($data, ['REGISTER_SONET_EVENT' => $is_test ? 'N' : 'Y']);
        if ($response['result']) {
            $order->bitrix_id = $response['result'];
            $order->save();
        }
    }


    public static function getParticipantsComment($data)
    {
        $comment = '';
        if (!empty($data['items'])) {
            foreach ($data['items'] as $item) {
                $part = trim($item['last_name'] . ' ' . $item['first_name'] . ' ' . $item['middle_name'] . ' ' . $item['birthday']);
                if (!empty($part)) {
                    $comment .= "$part\n";
                }
            }
            $comment .= "\n";
        }

        if (!empty($data['participant_phone'])) {
            $phone = $data['participant_phone'];

            $comment .= "Телефон одного з учасників: $phone\n";
        }
        return trim($comment);
    }

    public static function getAccommodationOther($text)
    {
        $comment = '<br /><div><strong>Поселення інше:</strong></div>';
        $comment .= "<div>$text</div>";
        $comment .= '<br />';
        return $comment;
    }


    public static function getPriceInclude($includes)
    {
        $items = [];
        foreach ($includes as $include) {
            $items[] = array_key_exists($include, Order::includes()) ? Order::includes()[$include] : $include;
        }
        return implode(', ', $items);
    }

}
