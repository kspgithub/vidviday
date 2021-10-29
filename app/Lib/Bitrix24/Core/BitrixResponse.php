<?php

namespace App\Lib\Bitrix24\Core;

class BitrixResponse
{

    public function __construct($status, $data = [])
    {
        $this->status = (int)$status;
        if (!empty($data['time'])) {
            $this->time = (object)$data['time'];
        }
        if (!empty($data['result'])) {
            $this->result = $data['result'];
        }
        if (isset($data['error'])) {
            $this->error = true;
        }
        if (isset($data['error_description'])) {
            $this->error_description = $data['error_description'];
        }
    }

    public $status = 0;

    /**
     * @var mixed|null
     */
    public $result = null;

    /**
     * @var object
     */
    public $time = null;

    /**
     * @var bool
     */
    public $error = false;

    /**
     * @var string
     */
    public $error_description = '';
}
