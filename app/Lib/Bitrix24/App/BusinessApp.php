<?php

namespace App\Lib\Bitrix24\App;

use App\Lib\Bitrix24\Core\BaseService;
use App\Lib\Bitrix24\Core\StaticServiceInterface;
use App\Lib\Bitrix24\Core\UseStaticService;
use Illuminate\Support\Facades\Log;

class BusinessApp
{
    public const ACTIVITY_TEST = [
        'CODE' => 'APP_TEST_ACTIVITY',
        'NAME' => 'Тестова дія',
        'DESCRIPTION' => 'Тестова дія смарт процесу',
        'PROPERTIES' => [
            'id' => [
                'Name' => 'ID',
                'Description' => 'ID запису',
                'Type' => 'string',
                'Multiple' => 'N',
                'Default' => null
            ],
            'event' => [
                'Name' => 'EVENT',
                'Description' => 'Подія',
                'Type' => 'string',
                'Multiple' => 'N',
                'Default' => null
            ],
        ],
        'DOCUMENT_TYPE' => ['Bitrix\Crm\Model\Dynamic\Type'],
    ];

    /**
     * @var BusinessApp
     */
    protected static $instance;


    public static function instance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public static function registerActivity()
    {
        self::addActivity(self::ACTIVITY_TEST);
    }


    public static function addActivity($params = [])
    {
        $params = array_merge([
            'HANDLER' => self::defaultHandler(),
            'AUTH_USER_ID' => config('services.bitrix24.user'),
            'USE_SUBSCRIPTION' => 'N',
        ], $params);

        $response = ActivityService::add($params);
        Log::info('Add Activity result', (array)$response);
    }

    public static function defaultHandler()
    {
        return url(route('crm.app.handler'));
    }
}
