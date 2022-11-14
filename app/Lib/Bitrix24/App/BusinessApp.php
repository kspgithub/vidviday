<?php

namespace App\Lib\Bitrix24\App;

use Illuminate\Support\Facades\Log;

class BusinessApp
{
    public const TOUR_UPDATE = [
        'CODE' => 'TOUR_UPDATE',
        'NAME' => 'Створення/Оновлення Туру',
        'DESCRIPTION' => 'ПОДІЯ Створення/Оновлення Туру',
        'PROPERTIES' => [
            'id' => [
                'Name' => 'ID',
                'Description' => 'ID запису',
                'Type' => 'string',
                'Multiple' => 'N',
                'Default' => null,
            ],
        ],
        'DOCUMENT_TYPE' => [
            'crm',
            "Bitrix\Crm\Integration\BizProc\Document\Dynamic",
            'DYNAMIC_167',
        ],

    ];

    public const TOUR_SCHEDULE_UPDATE = [
        'CODE' => 'TOUR_SCHEDULE_UPDATE',
        'NAME' => 'Створення/Оновлення Виїзду',
        'DESCRIPTION' => 'ПОДІЯ Створення/Оновлення Виїзду',
        'PROPERTIES' => [
            'id' => [
                'Name' => 'ID',
                'Description' => 'ID запису',
                'Type' => 'string',
                'Multiple' => 'N',
                'Default' => null,
            ],
        ],
        'DOCUMENT_TYPE' => [
            'crm',
            "Bitrix\Crm\Integration\BizProc\Document\Dynamic",
            'DYNAMIC_168',
        ],
    ];

    /**
     * @var BusinessApp
     */
    protected static $instance;

    public static function instance()
    {
        if (! self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function registerActivity()
    {
        $activities = [
            self::TOUR_UPDATE,
            self::TOUR_SCHEDULE_UPDATE,
        ];

        $response = ActivityService::list();

        $installedActivity = $response['result'] ?? [];

        foreach ($activities as $activity) {
            if (in_array($activity['CODE'], $installedActivity)) {
                self::updateActivity($activity);
            } else {
                self::addActivity($activity);
            }
        }
    }

    public static function addActivity($params = [])
    {
        $params = self::prepareParams($params);
        Log::info('Add Activity params', $params);
        $response = ActivityService::add($params);
        Log::info('Add Activity result', (array) $response);
    }

    public static function updateActivity($params = [])
    {
        $params = self::prepareParams($params);
        Log::info('Update Activity params', $params);
        $response = ActivityService::update($params);
        Log::info('Update Activity result', (array) $response);
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
