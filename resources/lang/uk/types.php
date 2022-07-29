<?php

use App\Helpers\Types\QuestionTypes;

return [
    'question-types' => [
        QuestionTypes::TOUR->value => 'Запитання що до туру',
        QuestionTypes::CERTIFICATE->value => 'Запитання що до сертифікату',
        QuestionTypes::OTHER->value => 'Інше',
    ]
];
