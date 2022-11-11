<?php

namespace App\Models\Traits\Attributes;

trait DiscountAttribute
{
    public function getModelAttribute()
    {
        return class_short_name($this->model_nameable_type);
    }
}
