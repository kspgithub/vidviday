<?php

namespace App\Helpers\Types;

enum QuestionTypes: string
{
    case TOUR = 'tour';
    case CERTIFICATE = 'certificate';
    case OTHER = 'other';

    public static function toSelectBox()
    {
        return array_map(function ($case) {
            return [
                'value' => $case->value,
                'title' => __('types.question-types.' . $case->value),
            ];
        }, self::cases());
    }
}
