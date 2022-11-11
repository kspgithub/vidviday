<?php

namespace App\Lib\Bitrix24\Core;

use App\Models\BitrixAppSettings;
use Exception;
use Illuminate\Support\Facades\Storage;

class CRest
{
    const VERSION = '1.36';

    const BATCH_COUNT = 50; //count batch 1 query

    const TYPE_TRANSPORT = 'json'; // json or xml

    /**
     * call where install application even url
     * only for rest application, not webhook
     */
    public static function installApp($params)
    {
        $result = [
            'rest_only' => true,
            'install' => false,
        ];
        if ($_REQUEST['event'] == 'ONAPPINSTALL' && ! empty($params['auth'])) {
            $result['install'] = static::setAppSettings($params['auth'], true);
        } elseif ($params['PLACEMENT'] == 'DEFAULT') {
            $result['rest_only'] = false;
            $result['install'] = static::setAppSettings(
                [
                    'access_token' => htmlspecialchars($params['AUTH_ID']),
                    'expires_in' => htmlspecialchars($params['AUTH_EXPIRES']),
                    'application_token' => htmlspecialchars($params['APP_SID']),
                    'refresh_token' => htmlspecialchars($params['REFRESH_ID']),
                    'domain' => htmlspecialchars($params['DOMAIN']),
                    'client_endpoint' => url(route('crm.app.handler')),
                ],
                true
            );
        }

        static::setLog(
            [
                'request' => $params,
                'result' => $result,
            ],
            'installApp'
        );

        return $result;
    }

    /**
     * @return mixed array|string|boolean curl-return or error
     *
     * @var array
     * $arParams = [
     *      'method'    => 'some rest method',
     *      'params'    => []//array params of method
     * ];
     */
    protected static function callCurl($arParams)
    {
        if (! function_exists('curl_init')) {
            return [
                'error' => 'error_php_lib_curl',
                'error_description' => 'need install curl lib',
            ];
        }
        $arSettings = static::getAppSettings();

        if ($arSettings !== false) {
            if (isset($arParams['this_auth']) && $arParams['this_auth'] == 'Y') {
                $url = 'https://oauth.bitrix.info/oauth/token/';
            } else {
                $url = $arSettings['client_endpoint'].$arParams['method'].'.'.static::TYPE_TRANSPORT;
                if (empty($arSettings['is_web_hook']) || $arSettings['is_web_hook'] != 'Y') {
                    $arParams['params']['auth'] = $arSettings['access_token'];
                }
            }

            $sPostFields = http_build_query($arParams['params']);

            try {
                $obCurl = curl_init();
                curl_setopt($obCurl, CURLOPT_URL, $url);
                curl_setopt($obCurl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($obCurl, CURLOPT_POSTREDIR, 10);
                curl_setopt($obCurl, CURLOPT_USERAGENT, 'Bitrix24 CRest PHP '.static::VERSION);
                if ($sPostFields) {
                    curl_setopt($obCurl, CURLOPT_POST, true);
                    curl_setopt($obCurl, CURLOPT_POSTFIELDS, $sPostFields);
                }
                curl_setopt(
                    $obCurl,
                    CURLOPT_FOLLOWLOCATION,
                    (isset($arParams['followlocation']))
                        ? $arParams['followlocation'] : 1
                );
                if (config('services.bitrix24.client_ignore_ssl')) {
                    curl_setopt($obCurl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($obCurl, CURLOPT_SSL_VERIFYHOST, false);
                }
                $out = curl_exec($obCurl);
                $info = curl_getinfo($obCurl);
                if (curl_errno($obCurl)) {
                    $info['curl_error'] = curl_error($obCurl);
                }
                if (static::TYPE_TRANSPORT == 'xml' && (! isset($arParams['this_auth']) || $arParams['this_auth'] != 'Y')) {//auth only json support
                    $result = $out;
                } else {
                    $result = static::expandData($out);
                }
                curl_close($obCurl);

                if (! empty($result['error'])) {
                    if ($result['error'] == 'expired_token' && empty($arParams['this_auth'])) {
                        $result = static::GetNewAuth($arParams);
                    } else {
                        $arErrorInform = [
                            'expired_token' => 'expired token, cant get new auth? Check access oauth server.',
                            'invalid_token' => 'invalid token, need reinstall application',
                            'invalid_grant' => 'invalid grant, check out define C_REST_CLIENT_SECRET or C_REST_CLIENT_ID',
                            'invalid_client' => 'invalid client, check out define C_REST_CLIENT_SECRET or C_REST_CLIENT_ID',
                            'QUERY_LIMIT_EXCEEDED' => 'Too many requests, maximum 2 query by second',
                            'ERROR_METHOD_NOT_FOUND' => 'Method not found! You can see the permissions of the application: CRest::call(\'scope\')',
                            'NO_AUTH_FOUND' => 'Some setup error b24, check in table "b_module_to_module" event "OnRestCheckAuth"',
                            'INTERNAL_SERVER_ERROR' => 'Server down, try later',
                        ];
                        if (! empty($arErrorInform[$result['error']])) {
                            $result['error_description'] = $arErrorInform[$result['error']];
                        }
                    }
                }
                if (! empty($info['curl_error'])) {
                    $result['error'] = 'curl_error';
                    $result['error_description'] = $info['curl_error'];
                }

                static::setLog(
                    [
                        'url' => $url,
                        'info' => $info,
                        'params' => $arParams,
                        'result' => $result,
                    ],
                    'callCurl'
                );

                return $result;
            } catch (Exception $e) {
                static::setLog(
                    [
                        'message' => $e->getMessage(),
                        'code' => $e->getCode(),
                        'trace' => $e->getTrace(),
                        'params' => $arParams,
                    ],
                    'exceptionCurl'
                );

                return [
                    'error' => 'exception',
                    'error_exception_code' => $e->getCode(),
                    'error_description' => $e->getMessage(),
                ];
            }
        } else {
            static::setLog(
                [
                    'params' => $arParams,
                ],
                'emptySetting'
            );
        }

        return [
            'error' => 'no_install_app',
            'error_description' => 'error install app, pls install local application ',
        ];
    }

    /**
     * Generate a request for callCurl()
     *
     * @return mixed array|string|boolean curl-return or error
     *
     * @var array method params
     * @var string
     */
    public static function call($method, $params = [])
    {
        $arPost = [
            'method' => $method,
            'params' => $params,
        ];
        $result = static::callCurl($arPost);

        return $result;
    }

    /**
     * @return array
     *
     * @var array
     * @var   int 0 or 1 stop batch on error
     *
     * @example $arData:
     * $arData = [
     *      'find_contact' => [
     *          'method' => 'crm.duplicate.findbycomm',
     *          'params' => [ "entity_type" => "CONTACT",  "type" => "EMAIL", "values" => array("info@bitrix24.com") ]
     *      ],
     *      'get_contact' => [
     *          'method' => 'crm.contact.get',
     *          'params' => [ "id" => '$result[find_contact][CONTACT][0]' ]
     *      ],
     *      'get_company' => [
     *          'method' => 'crm.company.get',
     *          'params' => [ "id" => '$result[get_contact][COMPANY_ID]', "select" => ["*"],]
     *      ]
     * ];
     */
    public static function callBatch($arData, $halt = 0)
    {
        $arResult = [];
        if (is_array($arData)) {
            $arDataRest = [];
            $i = 0;
            foreach ($arData as $key => $data) {
                if (! empty($data['method'])) {
                    $i++;
                    if (static::BATCH_COUNT >= $i) {
                        $arDataRest['cmd'][$key] = $data['method'];
                        if (! empty($data['params'])) {
                            $arDataRest['cmd'][$key] .= '?'.http_build_query($data['params']);
                        }
                    }
                }
            }
            if (! empty($arDataRest)) {
                $arDataRest['halt'] = $halt;
                $arPost = [
                    'method' => 'batch',
                    'params' => $arDataRest,
                ];
                $arResult = static::callCurl($arPost);
            }
        }

        return $arResult;
    }

    /**
     * Getting a new authorization and sending a request for the 2nd time
     *
     * @return array query result from $arParams
     *
     * @var array request when authorization error returned
     */
    private static function GetNewAuth($arParams)
    {
        $result = [];
        $arSettings = static::getAppSettings();
        if ($arSettings !== false) {
            $arParamsAuth = [
                'this_auth' => 'Y',
                'params' => [
                    'client_id' => $arSettings['C_REST_CLIENT_ID'],
                    'grant_type' => 'refresh_token',
                    'client_secret' => $arSettings['C_REST_CLIENT_SECRET'],
                    'refresh_token' => $arSettings['refresh_token'],
                ],
            ];
            $newData = static::callCurl($arParamsAuth);
            if (isset($newData['C_REST_CLIENT_ID'])) {
                unset($newData['C_REST_CLIENT_ID']);
            }
            if (isset($newData['C_REST_CLIENT_SECRET'])) {
                unset($newData['C_REST_CLIENT_SECRET']);
            }
            if (isset($newData['error'])) {
                unset($newData['error']);
            }
            if (static::setAppSettings($newData)) {
                $arParams['this_auth'] = 'N';
                $result = static::callCurl($arParams);
            }
        }

        return $result;
    }

    /**
     * @return bool
     *
     * @var  bool true if install app by installApp()
     * @var array settings application
     */
    private static function setAppSettings($arSettings, $isInstall = false)
    {
        $return = false;
        if (is_array($arSettings)) {
            $oldData = static::getAppSettings();
            if ($isInstall != true && ! empty($oldData) && is_array($oldData)) {
                $arSettings = array_merge($oldData, $arSettings);
            }
            $return = static::setSettingData($arSettings);
        }

        return $return;
    }

    /**
     * @return mixed setting application for query
     */
    private static function getAppSettings()
    {
        if (! empty(config('services.bitrix24.client_webhook'))) {
            $arData = [
                'client_endpoint' => config('services.bitrix24.client_webhook'),
                'is_web_hook' => 'Y',
            ];
            $isCurrData = true;
        } else {
            $arData = static::getSettingData();
            $isCurrData = false;
            if (
                ! empty($arData['access_token']) &&
                ! empty($arData['domain']) &&
                ! empty($arData['refresh_token']) &&
                ! empty($arData['application_token']) &&
                ! empty($arData['client_endpoint'])
            ) {
                $isCurrData = true;
            }
        }

        return ($isCurrData) ? $arData : false;
    }

    /**
     * Can overridden this method to change the data storage location.
     *
     * @return array setting for getAppSettings()
     */
    protected static function getSettingData()
    {
        $settings = BitrixAppSettings::query()->first();
        $return = [];
        if ($settings !== null) {
            $return = $settings->toArray();
            $return['C_REST_CLIENT_ID'] = config('services.bitrix24.client_id');
            $return['C_REST_CLIENT_SECRET'] = config('services.bitrix24.client_secret');
        }

        return $return;
    }

    /**
     * @return string json_encode with encoding
     *
     * @var bool
     * @var mixed
     */
    protected static function wrapData($data, $debag = false)
    {
        $return = json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);

        if ($debag) {
            $e = json_last_error();
            if ($e != JSON_ERROR_NONE) {
                if ($e == JSON_ERROR_UTF8) {
                    return 'Failed encoding! Recommended \'UTF - 8\' or set define C_REST_CURRENT_ENCODING = current site encoding for function iconv()';
                }
            }
        }

        return $return;
    }

    /**
     * @return string json_decode with encoding
     *
     * @var bool
     * @var mixed
     */
    protected static function expandData($data)
    {
        return json_decode($data, true);
    }

    /**
     * Can overridden this method to change the data storage location.
     *
     * @return bool is successes save data for setSettingData()
     *
     * @var array settings application
     */
    protected static function setSettingData($arSettings)
    {
        $settings = BitrixAppSettings::query()->first();
        if ($settings === null) {
            $settings = new BitrixAppSettings();
        }
        $settings->fill($arSettings);

        return $settings->save();
    }

    /**
     * Can overridden this method to change the log data storage location.
     *
     * @return bool is successes save log data
     *
     * @var   string to more identification log data
     * @var array of logs data
     */
    public static function setLog($arData, $type = '')
    {
        $return = false;

        if (Storage::exists('bitrix')) {
            Storage::makeDirectory('bitrix');
        }
        if (config('services.bitrix24.client_block_log')) {
            $path = '/logs/'.date('Y-m-d/H');

            if (! file_exists($path)) {
                Storage::makeDirectory($path);
            }

            $path .= '/'.time().'_'.$type.'_'.rand(1, 9999999).'log';
            if (! config('services.bitrix24.client_log_type_dump')) {
                $jsonLog = static::wrapData($arData);
                if ($jsonLog === false) {
                    $return = Storage::put($path.'_backup.txt', var_export($arData, true));
                } else {
                    $return = Storage::put($path.'.json', $jsonLog);
                }
            } else {
                $return = Storage::put($path.'.txt', var_export($arData, true));
            }
        }

        return $return;
    }

    /**
     * check minimal settings server to work CRest
     *
     * @return array of errors
     *
     * @var bool
     */
    public static function checkServer($print = true)
    {
        $return = [];

        //check curl lib install
        if (! function_exists('curl_init')) {
            $return['curl_error'] = 'Need install curl lib.';
        }

        //creat setting file
        Storage::put('bitrix/settings_check.json', static::wrapData(['test' => 'data']));

        if (! Storage::exists('bitrix/settings_check.json')) {
            $return['setting_creat_error'] = 'Check permission! Recommended: folders: 775, files: 664';
        }
        Storage::delete('bitrix/settings_check.json');

        //creat logs folder and files
        $path = 'bitrix/logs/'.date('Y-m-d/H');
        if (! Storage::exists($path)) {
            Storage::makeDirectory($path);
        }
        if (! Storage::exists($path)) {
            $return['logs_folder_creat_error'] = 'Check permission! Recommended: folders: 775, files: 664';
        } else {
            Storage::put($path.'/test.txt', var_export(['test' => 'data']));
            if (! Storage::exists($path.'/test.txt')) {
                $return['logs_file_creat_error'] = 'check permission! recommended: folders: 775, files: 664';
            }
            Storage::delete($path.'/test.txt');
        }

        if (empty($return)) {
            $return['success'] = 'Success!';
        }

        return $return;
    }
}
