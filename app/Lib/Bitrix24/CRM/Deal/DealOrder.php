<?php

namespace App\Lib\Bitrix24\CRM\Deal;

use App\Lib\Bitrix24\Core\HasPrice;
use App\Lib\Bitrix24\CRM\Contact\ContactService;
use App\Models\BitrixContact;
use App\Models\Order;
use App\Models\Tour;
use App\Models\TourSchedule;

class DealOrder
{
    use HasPrice;

    // Продаж туру
    public const CATEGORY_ID = 5;

    protected const FIELDS_MAP = [
        DealFields::FIELD_ID => 'bitrix_id',
        DealFields::FIELD_CONTACT_ID => 'bitrix_contact_id',
        DealFields::FIELD_TITLE => 'title',
        DealFields::FIELD_TOUR_ID => 'tour_id',
        DealFields::FIELD_SCHEDULE_ID => 'bitrix_schedule_id',
        DealFields::FIELD_STAGE_ID => 'status',
        DealFields::FIELD_GROUP_TYPE => 'group_type',
        DealFields::FIELD_CURRENCY => 'currency',
        DealFields::FIELD_TOTAL_AMOUNT => 'total',
        DealFields::FIELD_PRICE => 'price',
        DealFields::FIELD_COMMISSION => 'commission',
        DealFields::FIELD_DISCOUNT => 'discount',
        DealFields::FIELD_PAYMENT_COMMENT => 'payment_comment',

        DealFields::FIELD_START_DATE => 'start_date',
        DealFields::FIELD_END_DATE => 'end_date',

        DealFields::FIELD_CHILDREN => 'children',
        DealFields::FIELD_CHILDREN_YOUNG => 'children_young',
        DealFields::FIELD_CHILDREN_OLDER => 'children_older',
        DealFields::FIELD_PARTICIPANTS_COMMENT => 'participants_comment',

        DealFields::FIELD_COMMENTS => 'comment',
    ];

    protected const STATUSES_MAP = [
        'C5:NEW' => Order::STATUS_NEW, // Нова
        'C5:14' => Order::STATUS_BOOKED, // В обробці
        'C5:PREPARATION' => Order::STATUS_BOOKED, // Отримати рішення
        'C5:PREPAYMENT_INVOICE' => Order::STATUS_BOOKED, // ВІДПРАВИТИ РАХУНОК
        'C5:EXECUTING' => Order::STATUS_BOOKED, // ОТРИМАТИ ОПЛАТУ
        'C5:FINAL_INVOICE' => Order::STATUS_PENDING_CANCEL, // РАХУНОК ПРОСРОЧЕНО
        'C5:13' => Order::STATUS_PAYED, // ТУР ТРИВАЄ
        'C5:2' => Order::STATUS_COMPLETED, // Отримати після оплату/Акт
        'C5:WON' => Order::STATUS_COMPLETED, // Успішне Виконання
        'C5:LOSE' => Order::STATUS_CANCELED, // Не отримали оплату
        'C5:7' => Order::STATUS_CANCELED, // Передумав
        'C5:8' => Order::STATUS_CANCELED, // Купив у конкурента
        'C5:9' => Order::STATUS_CANCELED, // ДОРОГО
        'C5:10' => Order::STATUS_CANCELED, // НЕ ГОТОВИЙ
        'C5:11' => Order::STATUS_CANCELED, // НЕАДЕКВАТНИЙ
        'C5:12' => Order::STATUS_CANCELED, // ЗНИК
    ];

    public static function createOrUpdate($bitrix_id, $data)
    {
        $order = Order::whereBitrixId($bitrix_id)->first();
        if ($order === null) {
            $order = new Order();
            $order->bitrix_id = $bitrix_id;
        }

        if ($order->user_id === null) {
            $bitrixContact = BitrixContact::whereBitrixId($data[DealFields::FIELD_CONTACT_ID])->first();
            if ($bitrixContact && $bitrixContact->user_id > 0) {
                $order->user_id = $bitrixContact->user_id;
            }
        }

        $order->status = self::STATUSES_MAP[$data[DealFields::FIELD_STAGE_ID]];

        if (! empty($data[DealFields::FIELD_GROUP_TYPE])) {
            $order->group_type = (int) array_flip(DealFields::GROUP_TYPE_VALUES)[$data[DealFields::FIELD_GROUP_TYPE]];
        }

        if (! empty($data[DealFields::FIELD_START_DATE])) {
            $order->start_date = $data[DealFields::FIELD_START_DATE];
        }

        if (! empty($data[DealFields::FIELD_END_DATE])) {
            $order->end_date = $data[DealFields::FIELD_END_DATE];
        }

        $order->currency = $data[DealFields::FIELD_CURRENCY] ?? 'UAH';
        if (! empty($data[DealFields::FIELD_PRICE])) {
            $order->price = (int) $data[DealFields::FIELD_PRICE];
        }
        if (! empty($data[DealFields::FIELD_COMMISSION])) {
            $order->commission = self::extractPrice($data[DealFields::FIELD_COMMISSION]);
        }
        if (! empty($data[DealFields::FIELD_DISCOUNT])) {
            $order->discount = self::extractPrice($data[DealFields::FIELD_DISCOUNT]);
        }
        $order->payment_comment = $data[DealFields::FIELD_PAYMENT_COMMENT] ?? '';

        if (! empty($data[DealFields::FIELD_SCHEDULE_ID])) {
            $schedule = TourSchedule::whereBitrixId($data[DealFields::FIELD_SCHEDULE_ID])->first();
            if ($schedule) {
                $order->schedule_id = $schedule->id;
                $order->tour_id = $schedule->tour_id;
            }
        } elseif (! empty($data[DealFields::FIELD_TOUR_ID])) {
            $tour = Tour::whereBitrixId($data[DealFields::FIELD_TOUR_ID][0])->first();
            if ($tour !== null) {
                $order->tour_id = $tour->id;
            }
        }

        if (! empty($data[DealFields::FIELD_CHILDREN])) {
            $order->children = (bool) $data[DealFields::FIELD_CHILDREN];
            if ($order->children) {
                $order->children_young = (int) $data[DealFields::FIELD_CHILDREN_YOUNG];
                $order->children_older = (int) $data[DealFields::FIELD_CHILDREN_OLDER];
            }
        }
        $order->participants_comment = $data[DealFields::FIELD_PARTICIPANTS_COMMENT] ?? '';
        $accommodation = [];
        foreach (DealFields::ACCOMMODATION_FIELDS_COMPARISON as $key => $field) {
            if ($key !== 'other') {
                $accommodation[$key] = ! empty($data[$field]) ? (int) $data[$field] : 0;
            }
            if ($key === 'other' ?? ! empty(trim($data[$field]))) {
                $accommodation['other'] = 1;
                $accommodation['other_text'] = trim($data[$field]);
            }
        }
        $order->accommodation = $accommodation;

        $order->save();
    }

    public static function createCrmDeal(Order $order)
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
            $data[DealFields::FIELD_TEST] = true;
        }

        if (! empty($contactId)) {
            $data[DealFields::FIELD_CONTACT_ID] = $contactId;
        }
        $tour = $order->tour_id > 0 ? Tour::withTrashed()->where('id', $order->tour_id)->first() : null;
        $tour->setLocale('uk');

        $data[DealFields::FIELD_CATEGORY_ID] = self::CATEGORY_ID;
        //$data[DealFields::FIELD_TITLE] = 'Замовлення туру: ' . (!empty($tour) > 0 ? $tour->title : 'Корпоратив') . ', ID ' . $order->id;

        if (! empty($tour) && (int) $tour->bitrix_id > 0) {
            $data[DealFields::FIELD_TOUR_ID] = [$tour->bitrix_id];
        }

        $data[DealFields::FIELD_GROUP_TYPE] = DealFields::GROUP_TYPE_VALUES[$order->group_type];
        $data[DealFields::FIELD_START_DATE] = $order->start_date->format('d.m.Y');
        $data[DealFields::FIELD_PLACES] = $order->places;

        if (! empty($order->end_date)) {
            $data[DealFields::FIELD_END_DATE] = $order->end_date->format('d.m.Y');
        }

        $data[DealFields::FIELD_CHILDREN] = $order->children;

        if ($order->children) {
            $data[DealFields::FIELD_CHILDREN_YOUNG] = $order->children_young;
            $data[DealFields::FIELD_CHILDREN_OLDER] = $order->children_older;
        }

        if ($order->price > 0) {
            $data[DealFields::FIELD_PRICE] = $order->price;
            $data[DealFields::FIELD_CURRENCY] = $order->currency;
            $data[DealFields::FIELD_DISCOUNT] = $order->discount;
            $data[DealFields::FIELD_COMMISSION] = $order->commission;
            $data[DealFields::FIELD_TOTAL_AMOUNT] = $order->total_price;

            if (! empty($order->discounts)) {
                $discountComment = '';
                foreach ($order->discounts as $discount) {
                    $discountComment .= "{$discount['title']} - {$discount['value']} $order->currency\n";
                }
                $data[DealFields::FIELD_PAYMENT_COMMENT] = $discountComment;
            }
        }

        $comment = '';

        if ($order->group_type === Order::GROUP_TEAM) {
            if ($order->additional) {
                foreach ($order->accommodation as $key => $quantity) {
                    if ($key !== 'other' && $key !== 'other_text' && (int) $quantity > 0) {
                        $data[DealFields::ACCOMMODATION_FIELDS_COMPARISON[trim($key)]] = (int) $quantity;
                    }
                }
                if (! empty($order->accommodation['other']) && (int) $order->accommodation['other'] === 1 && ! empty($order->accommodation['other_text'])) {
                    $data[DealFields::ACCOMMODATION_FIELDS_COMPARISON['other']] = $order->accommodation['other_text'];
                }

                $participants_comment = $order->getParticipantsComment();
                if (! empty($participants_comment)) {
                    $data[DealFields::FIELD_PARTICIPANTS_COMMENT] = $participants_comment;
                }
            }
        }

        if ($order->group_type === Order::GROUP_CORPORATE) {
            $aboutCorporate = '<br /><div><strong>Інформація про корпоратив:</strong></div><br />';
            $aboutCorporate .= "<div><strong>Місце виїзду:</strong> $order->start_place</div>";
            $aboutCorporate .= "<div><strong>Місце повернення:</strong> $order->end_place</div>";

            if ($order->program_type === Order::PROGRAM_CUSTOM) {
                $aboutCorporate .= "<br /><div><strong>План туру:</strong> $order->tour_plan</div>";
            }

            $data[DealFields::FIELD_START_DATE] = $order->start_date;
            $data[DealFields::FIELD_END_DATE] = $order->end_date;

            $aboutCorporate .= "<br /><div><strong>Особливості групи:</strong> $order->group_comment</div>";
            $aboutCorporate .= "<br /><div><strong>Побажання та умови:</strong> $order->program_comment</div>";
            if (! empty($order->price_include)) {
                $includes = self::getPriceInclude($order->price_include);
                $aboutCorporate .= "<br /><div><strong>Включити у вартість:</strong> $includes</div>";
            }
            if (! empty($order->offer_date)) {
                $offer_date = $order->offer_date->format('d.m.Y');
                $aboutCorporate .= "<br /><div><strong>Надіслати пропозицію до:</strong> $offer_date</div>";
            }

            $comment .= $aboutCorporate;
        }

        if ($order->payment_type > 0) {
            $data[DealFields::FIELD_PAYMENT_TYPE] = DealFields::PAYMENT_TYPE_VALUES[$order->payment_type];
        }

        if ($order->confirmation_type > 0) {
            $data[DealFields::FIELD_CONFIRMATION_TYPE] = DealFields::CONFIRMATION_VALUES[$order->confirmation_type];
            $confirmation_name = DealFields::CONFIRMATION_NAMES[$order->confirmation_type];
            $comment .= "<br /><div><strong>Підтвердити на $confirmation_name:</strong> $order->confirmation_contact</div>";
        }

        if (! empty($order->comment)) {
            $comment .= '<br /><div><strong>Примітки:</strong></div>';
            $comment .= "<div>$order->comment</div>";
            $comment .= '<br />';
        }

        $data[DealFields::FIELD_COMMENTS] = $comment;

        $response = DealService::add($data, ['REGISTER_SONET_EVENT' => $is_test ? 'N' : 'Y']);
        if (! $response->error) {
            $order->bitrix_id = $response->result;
            $order->save();
        }
    }

    public static function cancelDeal(Order $order)
    {
        //TODO: Необходимо реализовать
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
