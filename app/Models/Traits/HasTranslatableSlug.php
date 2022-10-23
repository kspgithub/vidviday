<?php

namespace App\Models\Traits;

use Illuminate\Support\Traits\Localizable;

trait HasTranslatableSlug
{
    use HasSlug, Localizable;
}
