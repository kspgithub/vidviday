<?php

namespace App\Models\Traits\Methods;

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
            $this->tourHistory()->detach([$id]);
        }
        $this->tourHistory()->attach([$id]);
        if ($this->tourHistory()->count() > 36) {
            $detach_ids = array_slice(array_values($this->tourHistory()->get(['id'])->pluck('id')->toArray()), 36);
            $this->tourHistory()->detach($detach_ids);
        }
    }
    

    public function isManagerOfOrder(Order $order)
    {
        return $this->isTourManager() && $order->tour_manager && $order->tour_manager->user_id === $this->id;
    }
}
