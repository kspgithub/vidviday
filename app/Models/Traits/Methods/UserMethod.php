<?php

namespace App\Models\Traits\Methods;

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
        return $this->status === self::STATUS_ACTIVE;
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
        return  self::query()->selectRaw("CONCAT_WS(' ', last_name, first_name) as text, id as value")
            ->get()->map(function ($it) {
                return ['value'=>$it->value, 'text'=>$it->text];
            });
    }

}
