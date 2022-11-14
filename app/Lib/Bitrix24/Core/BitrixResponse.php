<?php

namespace App\Lib\Bitrix24\Core;

class BitrixResponse
{
    public function __construct($data = [])
    {
        if (! empty($data['time'])) {
            $this->time = (object) $data['time'];
        }
        if (! empty($data['result'])) {
            $this->result = $data['result'];
        }
        if (! empty($data['error'])) {
            $this->error = $data['error'];
        }

        if (isset($data['error_description'])) {
            $this->error_description = $data['error_description'];
        }

        if (isset($data['error_exception_code'])) {
            $this->error_exception_code = $data['error_exception_code'];
        }
    }

    /**
     * @var mixed|null
     */
    public $result = null;

    /**
     * @var object
     */
    public $time = null;

    /**
     * @var bool|string
     */
    public $error = false;

    /**
     * @var string
     */
    public $error_description = '';

    /**
     * @var string
     */
    public $error_exception_code = '';
}
