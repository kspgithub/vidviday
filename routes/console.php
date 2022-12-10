<?php

use App\Mail\CustomEmail;
use App\Mail\UserQuestionEmail;
use App\Models\LanguageLine;
use App\Models\QuestionType;
use App\Models\Tour;
use App\Models\UserQuestion;
use App\Services\MailNotificationService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());

    $url = 'http:/localhost:3000/render';
    $page['component'] = 'test-component';
    $page['props'] = ['foo' => 'bar123'];

    try {
        $response = Http::post($url, $page)->throw()->body();

        dd($response);

    } catch (\Exception $e) {
        dd($e);
    }
    $data = \Illuminate\Support\Facades\Http::post('http://localhost:3000/render', [
        'query' => [
            'component' => $component,
            'props' => $props,
        ]
    ]);
    $params = [];

    $className = 'App\Mail\OrderCertificateMail';

    $reflectionClass = new \ReflectionClass($className);

    $constructorParams = $reflectionClass->getConstructor()?->getParameters() ?: [];

    foreach ($constructorParams as $param) {
        $value = '';
        $type = $param->getType();

        if(class_exists($type)) {
            $class = app($type);
            if($class instanceof Model) {
                $value = $class->random();
            }
        }

        $params[$param->getName()] = $value;
    }
    dd($params);

})->purpose('Display an inspiring quote');
