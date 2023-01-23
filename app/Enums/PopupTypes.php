<?php

namespace App\Enums;

enum PopupTypes: string
{
    case ONE_CLICK = 'one_click';
    case ORDER_CALLBACK = 'order_calback';
    case WRITE_EMAIL = 'write_email';
    case NEWSLETTER = 'newsletter';
    case TESTIMONIAL = 'testimonial';
    case QUESTION = 'question';
}
