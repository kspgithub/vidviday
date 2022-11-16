<?php

namespace App\Models\Traits\Methods;

use App\Lib\WayForPay\PurchaseAbstract;
use App\Lib\WayForPay\PurchaseTour;
use App\Models\BitrixContact;
use App\Models\Discount;
use App\Models\PurchaseTransaction;

trait OrderMethods
{
    public function getParticipantsComment()
    {
        $data = $this->participants;
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

    public function cancel($data)
    {
        $this->abolition = $data;
        $this->status = self::STATUS_PENDING_CANCEL;
        $this->save();
    }

    public function isOverloaded()
    {
        return $this->schedule ? $this->schedule->places_available < $this->total_places : false;
    }


    public function syncContact()
    {
        $emails = array_filter([$this->email]);

        $phones = array_filter(array_unique([$this->phone, clear_phone($this->phone, false), clear_phone($this->phone, true)]));
        if (!empty($emails) || !empty($phones)) {
            $query = BitrixContact::query();
            $first = true;
            foreach ($phones as $phone) {
                if ($first) {
                    $query->whereJsonContains('phone', $phone);
                    $first = false;
                } else {
                    $query->orWhereJsonContains('phone', $phone);
                }
            }
            foreach ($emails as $email) {
                if ($first) {
                    $query->whereJsonContains('email', $email);
                    $first = false;
                } else {
                    $query->orWhereJsonContains('email', $email);
                }
            }
            $contact = $query->first();
            if (empty($contact)) {
                $contact = new BitrixContact();
                $contact->user_id = $this->user_id;
                $contact->phone = $phones;
                $contact->email = $emails;
                $contact->first_name = $this->first_name;
                $contact->last_name = $this->last_name;
                $contact->save();
                return true;
            }
            if (!empty($contact)) {
                $this->contact_id = $contact->id;
                $this->save();
            }

        }

        return false;
    }

    public function recalculatePrice()
    {
        $order_params = $this->toArray();

        $total_places = $order_params['places'];

        $tour = $this->tour;

        $schedule = $this->schedule;

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

        $accomm_price = $schedule ? $schedule->accomm_price : $tour->accomm_price;
        $total_accomm = 0;

        $order_params['children'] = $params['children'] ?? 0;
        if ((int)$order_params['children'] === 1) {
            $order_params['children_young'] = (int)$params['children_young'] ?? 0;
            $order_params['children_older'] = (int)$params['children_older'] ?? 0;
            $order_params['without_place_count'] = (int)$params['without_place_count'] ?? 0;
            $order_params['without_place'] = $order_params['without_place_count'] > 0 ? 1 : 0;
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
                'without_place' => $order_params['without_place'] ?? 0,
                'without_place_count' => $order_params['without_place_count'] ?? 0,
                'items' => $params['participants'] ?? [],
                'participant_phone' => $params['participant_phone'] ?? '',
            ];

            if (isset($params['accommodation'])) {
                $items = [];
                foreach ($params['accommodation'] as $key => $value) {
                    $accomm_slug = str_replace('-', '_', $key);

                    if ((int)$value > 0 && $key !== 'other' && $key !== 'other_text') {
                        $items[$accomm_slug] = (int)$value;
                        if ($accomm_slug === '1o_sgl' && $value > 0) {
                            $total_accomm = $accomm_price * (int)$value;
                        }
                    }
                    if ($key === 'other' && (int)$value === 1) {
                        $items['other'] = $params['accommodation']['other_text'] ?? '';
                    }
                }

                $order_params['accommodation'] = $items;
            }
        }

        $other_discounts = $tour->discounts()->available()->where('tours_discounts.age_limit', 0)
            ->whereNotIn('tours_discounts.category', ['children_young', 'children', 'children_older'])->get();

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
        $order_params['accomm_price'] = $total_accomm;

        return $this->update($order_params);
    }


    public function purchaseWizard(): PurchaseAbstract
    {
        return new PurchaseTour($this);
    }

}
