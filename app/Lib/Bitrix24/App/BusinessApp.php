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
        $response = ActivityService::list();

        $installedActivity = $response['result'] ?? [];

        if (in_array(self::ACTIVITY_TEST['CODE'], $installedActivity)) {
            self::updateActivity(self::ACTIVITY_TEST);
        } else {
            self::addActivity(self::ACTIVITY_TEST);
        }

    }


    public static function addActivity($params = [])
    {
        $params = self::prepareParams($params);
        Log::info('Add Activity params', $params);
        $response = ActivityService::add($params);
        Log::info('Add Activity result', (array)$response);
    }

    public static function updateActivity($params = [])
    {
        $params = self::prepareParams($params);
        Log::info('Update Activity params', $params);
        $response = ActivityService::update($params);
        Log::info('Update Activity result', (array)$response);
    }

    public static function prepareParams($params = [])
    {
        return array_merge([
            'HANDLER' => self::defaultHandler(),
            'AUTH_USER_ID' => config('services.bitrix24.user'),
            'USE_SUBSCRIPTION' => 'N',
        ], $params);
    }

    public static function defaultHandler()
    {
        return url(route('crm.app.handler'));
    }
}
