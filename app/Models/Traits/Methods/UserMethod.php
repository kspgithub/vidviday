<?php

namespace App\Models\Traits\Methods;

use App\Models\BitrixContact;
use App\Models\Order;

trait UserMethod
{
    public function isMasterAdmin()
    {
        return $this->id === 1;
    }

    public function isAdmin(): bool
    {
        return $this->id === 1 || $this->hasRole('admin');
    }

    public function isTourist(): bool
    {
        return $this->hasRole('tourist');
    }

    public function isTourAgent(): bool
    {
        return $this->hasRole('tour-agent');
    }

    public function isManager(): bool
    {
        return $this->hasRole('manager');
    }

    public function isTourManager(): bool
    {
        return $this->hasRole('tour-manager');
    }

    public function isDutyManager(): bool
    {
        return $this->hasRole('duty-manager');
    }


    /**
     * @return bool
     */
    public function isVerified(): bool
    {
        return $this->email_verified_at !== null;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return (int)$this->status === self::STATUS_ACTIVE;
    }

    /**
     * @return bool
     */
    public function isSocial(): bool
    {
        return false;
    }


    public static function toSelectBox()
    {
        return self::query()->selectRaw("CONCAT_WS(' ', last_name, first_name) as text, id as value")
            ->get()->map(function ($it) {
                return ['value' => $it->value, 'text' => $it->text];
            });
    }

    public function basicInfo()
    {
        return (object)[
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'name' => $this->name,
            'email' => $this->email,
            'mobile_phone' => $this->mobile_phone,
            'company' => $this->company,
            'role' => $this->role,
            'avatar_url' => $this->avatar_url,
        ];
    }

    public function asCrmUser()
    {
        return (object)[
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'name' => $this->name,
            'email' => $this->email,
            'mobile_phone' => json_prepare($this->mobile_phone),
            'company' => json_prepare($this->company),
            'role' => $this->role,
            'roles' => $this->roles->pluck('name')->toArray(),
            'avatar_url' => $this->avatar_url,
        ];
    }

    public function viewTour($id)
    {
        if ($this->tourHistory()->whereId($id)->count() > 0) {
            $this->tourHistory()->detach($id);
        }
        $this->tourHistory()->attach($id, ['created_at' => now(), 'updated_at' => now()]);

        // todo: Для чего задан лимит? почему 36?
//        $count = $this->tourHistory()->count();
//        $limit = 36;
//        if ($count > $limit) {
//            $detach_ids = array_slice(array_values($this->tourHistory()->get(['id'])->pluck('id')->toArray()), $limit);
//            $this->tourHistory()->detach($detach_ids);
//        }
    }


    public function isManagerOfOrder(Order $order)
    {
        return $this->isTourManager() && $order->tour_manager && $order->tour_manager->user_id === $this->id;
    }

    public function syncContact()
    {
        $emails = array_filter([$this->email]);

        $phones = array_filter(array_unique([$this->mobile_phone, clear_phone($this->mobile_phone, false), clear_phone($this->mobile_phone, true)]));
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
                $contact->user_id = $this->id;
                $contact->phone = $phones;
                $contact->email = $emails;
                $contact->first_name = $this->first_name;
                $contact->last_name = $this->last_name;
                $contact->save();
                return true;
            }
        }

        return false;
    }
}
