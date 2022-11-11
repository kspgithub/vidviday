<?php

namespace App\Models\Traits\Attributes;

use Illuminate\Support\Str;

trait OrderAttribute
{
    public function getStartTitleAttribute()
    {
        if ($this->start_date && $this->end_date) {
            if ($this->start_date->month === $this->end_date->month && $this->start_date->year === $this->end_date->year &&
                $this->start_date->translatedFormat('D') !== $this->end_date->translatedFormat('D')) {
                return Str::ucfirst($this->start_date->translatedFormat('D')).' - '.
                    Str::ucfirst($this->end_date->translatedFormat('D')).
                    ', '.$this->start_date->format('d').' - '.$this->end_date->format('d.m.Y');
            }

            return $this->start_date->format('d.m.Y').' - '.$this->end_date->format('d.m.Y');
        }

        if ($this->start_date) {
            return $this->start_date->translatedFormat('D').', '.$this->start_date->format('d.m.Y');
        }

        return '';
    }

    public function getEventTitleAttribute()
    {
        if ($this->start_date) {
            return $this->start_date->translatedFormat('D').', '.$this->start_date->format('d.m.Y');
        }

        return '';
    }

    /**
     * Продолжительность дней
     *
     * @return int|mixed
     */
    public function getDurationAttribute()
    {
        if ($this->tour_id > 0) {
            return $this->tour->duration;
        }

        if ($this->start_date && $this->end_date) {
            return $this->start_date->diffInDays($this->end_date);
        }

        return 0;
    }

    /**
     * Количество мест
     *
     * @return int|mixed
     */
    public function getTotalPlacesAttribute()
    {
        $total = $this->places;
        if ($this->children) {
            $total += $this->children_young;
            $total += $this->children_older;
        }

        return $total;
    }

    /**
     * Количество детей
     *
     * @return int|mixed
     */
    public function getTotalChildrenAttribute()
    {
        $total = 0;
        if ($this->children) {
            $total += $this->children_young;
            $total += $this->children_older;
        }

        return $total;
    }

    /**
     * Общая стоимость с учетом скидок и доплат
     *
     * @return int|mixed|null
     */
    public function getTotalPriceAttribute(): int
    {
        $total = $this->price - $this->discount + $this->accomm_price;

        return $this->is_tour_agent ? $total - $this->commission : $total;
    }

    /**
     * Заглавие типа оплаты
     *
     * @return mixed|string
     */
    public function getPaymentTitleAttribute()
    {
        return $this->payment ? $this->payment->title : '';
    }

    /**
     * Менеджер тура
     *
     * @return object|null
     */
    public function getTourManagerAttribute()
    {
        return $this->tour && $this->tour->manager ? $this->tour->manager->shortInfo() : null;
    }

    /**
     * Дособирать
     *
     * @return int|mixed|null
     */
    public function getPaymentGetAttribute()
    {
        return $this->total_price - $this->payment_fop - $this->payment_tov - $this->payment_office - $this->payment_online;
    }

    /**
     * @return string
     */
    public function getTitleAttribute(): string
    {
        $title = $this->group_type == self::GROUP_CORPORATE ? 'Корпоратив: ' : 'Тур: ';

        if ($this->tour_id > 0) {
            $title .= $this->tour->title;
        } else {
            $title .= ' за побажанням кліента';
        }
        $title .= ($this->start_date ? ', '.$this->start_date->format('d.m.Y') : '');

        return $title;
    }
}
