<?php

namespace App\Services;

use App\Models\Discount;
use App\Models\Order;
use App\Models\Tour;
use App\Models\TourSchedule;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService extends BaseService
{
    /**
     * OrderService constructor.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public static function createOrder($params = [])
    {
        // Основные параметры
        $order_params = [
            'first_name' => $params['first_name'] ?? '',
            'last_name' => $params['last_name'] ?? '',
            'phone' => $params['phone'] ?? '',
            'email' => $params['email'] ?? '',
            'group_type' => (int)$params['group_type'],
            'places' => (int)$params['places'],
            'tour_id' => $params['tour_id'] ?? null,
            'schedule_id' => isset($params['schedule_id']) && (int)$params['schedule_id'] > 0 ? (int)$params['schedule_id'] : null,
            'user_id' => $params['user_id'] ?? null,
            'comment' => $params['comment'] ?? '',
            'act_is_needed' => $params['act_is_needed'] ?? 0,
            'is_tour_agent' => $params['is_tour_agent'] ?? 0,
            'agency_data' => $params['agency_data'] ?? null,
            'status' => Order::STATUS_NEW,
            'duty_comment' => '',
        ];


        // Сборная группа
        if ($order_params['group_type'] === 0) {
            $total_places = $order_params['places'];

            $tour = Tour::find($order_params['tour_id']);

            $schedule = TourSchedule::find($order_params['schedule_id']);


            $tour_price = $schedule ? $schedule->price : $tour->price;
            $tour_commission = $schedule ? $schedule->commission : $tour->commission;
            $tour_currency = $schedule ? $schedule->currency : $tour->currency;
            $places = (int)$order_params['places'];
            $days = $tour->duration;
            $order_price = $tour_price * $places;
            $order_commission = $tour_commission * $places;


            $order_discounts = [];
            $total_discount = 0;
            $children_discount = 0;

            if ($schedule) {
                $order_params['start_date'] = $schedule->start_date->format('d.m.Y');
            }


            $order_params['children'] = $params['children'] ?? 0;
            if ((int)$order_params['children'] === 1) {
                $order_params['children_young'] = (int)$params['children_young'] ?? 0;
                $order_params['children_older'] = (int)$params['children_older'] ?? 0;
                $total_places += $order_params['children_young'];
                $total_places += $order_params['children_older'];

                if (!$tour->isYoungChildrenFree() && !$tour->isChildrenFree()) {
                    $order_price += $tour_price * (int)$params['children_young'];
                    $order_commission += $tour_commission * (int)$params['children_young'];
                    $discount = $tour->discounts()->available()
                        ->whereIn('category', ['children_young', 'children'])->first();
                    if ($discount) {
                        $children_discount += $discount->calculate($tour_price, (int)$params['children_young'], $days);
                    }
                }
                if (!$tour->isOlderChildrenFree() && !$tour->isChildrenFree()) {
                    $order_price += $tour_price * (int)$params['children_older'];
                    $order_commission += $tour_commission * (int)$params['children_older'];

                    $discount = $tour->discounts()->available()
                        ->whereIn('category', ['children_older', 'children'])->first();
                    if ($discount) {
                        $children_discount += $discount->calculate($tour_price, (int)$params['children_older'], $days);
                    }
                }

                if ($children_discount > 0) {
                    $total_discount += $children_discount;
                    $order_discounts[] = ['title' => 'Знижка за дітей', 'value' => $children_discount];
                }
            }

            if (isset($params['additional']) && (int)$params['additional'] === 1) {
                $order_params['participants'] = [
                    'items' => $params['participants'] ?? [],
                    'participant_phone' => $params['participant_phone'] ?? '',
                ];

                if (isset($params['accommodation'])) {
                    $items = [];
                    foreach ($params['accommodation'] as $key => $value) {
                        if ((int)$value > 0 && $key !== 'other' && $key !== 'other_text') {
                            $items[str_replace('_', '-', $key)] = (int)$value;
                        }
                        if ($key === 'other' && (int)$value === 1) {
                            $items['other'] = $params['accommodation']['other_text'] ?? '';
                        }
                    }

                    $order_params['accommodation'] = $items;
                }
            }

            $other_discounts = $tour->discounts()->available()->where('age_limit', 0)
                ->whereNotIn('category', ['children_young', 'children', 'children_older'])->get();

            /*
             * Подсчет скидок
             */
            foreach ($other_discounts as $discount) {
                if ($discount->duration === Discount::DURATION_ORDER) {
                    $discount_value = $discount->calculate($order_price);
                } else {
                    $discount_value = $discount->calculate($tour_price, $places, $days);
                }
                $total_discount += $discount_value;
                $order_discounts[] = ['title' => $discount->title, 'value' => $discount_value];
            }

            $order_params['price'] = $order_price;
            $order_params['commission'] = $order_params['is_tour_agent'] ? $order_commission : 0;
            $order_params['discount'] = $total_discount;
            $order_params['discounts'] = $order_discounts;
            $order_params['currency'] = $tour_currency;

            $schedule = $schedule->availableForBooking($total_places);

            if ($schedule->isAutoBookingAvailable($total_places)) {
                $order_params['status'] = Order::STATUS_BOOKED;
                $order_params['auto'] = true;
            }

            if (($schedule->places_available - $schedule->places_new) < $total_places) {
                $order_params['status'] = Order::STATUS_RESERVE;
            }

            $order_params['schedule_id'] = $schedule->id;

        }

        // Корпоративная группа
        if ($order_params['group_type'] === 1) {
            $order_params['group_comment'] = $params['group_comment'] ?? '';
            $order_params['program_comment'] = $params['program_comment'] ?? '';
            $order_params['program_type'] = $params['program_type'] ?? 0;
            $order_params['start_date'] = $params['start_date'] ?? null;
            $order_params['start_place'] = $params['start_place'] ?? null;
            $order_params['end_date'] = $params['end_date'] ?? null;
            $order_params['end_place'] = $params['end_place'] ?? null;
            $order_params['price_include'] = $params['price_include'] ?? [];
            $order_params['offer_date'] = $params['offer_date'] ?? null;


            if ((int)$order_params['program_type'] === 1) {
                $order_params['tour_plan'] = $params['tour_plan'] ?? '';
            }
        }

        if (!$params['is_tour_agent']) {
            $order_params['confirmation_type'] = $params['confirmation_type'] ?? 0;
            switch ((int)$order_params['confirmation_type']) {
                case 1:
                    $order_params['confirmation_contact'] = $params['confirmation_email'] ?? '';
                    break;
                case 2:
                    $order_params['confirmation_contact'] = $params['confirmation_viber'] ?? '';
                    break;
                case 3:
                    $order_params['confirmation_contact'] = $params['confirmation_phone'] ?? '';
                    break;
            }
            $order_params['payment_type'] = $params['payment_type'] ?? 0;
        }

        DB::beginTransaction();

        try {
            $order = new Order();
            $order->fill($order_params);
            $order->save();
        } catch (Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            DB::rollBack();
            return false;
        }

        DB::commit();

        return $order;
    }
}
