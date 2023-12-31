<?php

namespace App\Lib\Bitrix24\Core;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Client
{
    protected static $instance;

    private $url;


    /**
     * @var Response
     */
    private $response;

    public function __construct()
    {
        $url = rtrim(config('services.bitrix24.domain'), "/") . '/rest';
        $user = config('services.bitrix24.user');
        $token = config('services.bitrix24.token');

        $this->url = $url . '/' . $user . '/' . $token;
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function getUrl($bitrixMethod)
    {
        return $this->url . '/' . $bitrixMethod;
    }


    private function request($bitrixMethod, $params = [])
    {
        $this->response = CRest::call($bitrixMethod, $params);
    }

    /**
     * @return BitrixResponse
     */
    public function getResponse()
    {
        return new BitrixResponse($this->response);
    }

    /**
     * @param string $bitrixMethod
     * @param array $params
     * @return BitrixResponse
     */
    public static function call($bitrixMethod, $params = [])
    {
        $instance = self::getInstance();
        $instance->request($bitrixMethod, $params);
        return $instance->getResponse();
    }

}
