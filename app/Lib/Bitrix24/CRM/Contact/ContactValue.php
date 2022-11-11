<?php

namespace App\Lib\Bitrix24\CRM\Contact;

use App\Lib\Bitrix24\Core\HasAttributes;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

/**
 * @property string $value
 * @property string $value_type
 */
class ContactValue implements Arrayable, Jsonable
{
    use HasAttributes;

    public const FIELD_VALUE = 'VALUE';

    public const FIELD_VALUE_TYPE = 'VALUE_TYPE';

    public const CONTACT_TYPE_MOBILE = 'MOBILE';

    public const CONTACT_TYPE_WORK = 'WORK';

    public const CONTACT_TYPE_HOME = 'HOME';

    protected $fillable = [
        'value',
        'value_type',
    ];

    public function __construct($attributes = [])
    {
        $this->fill($attributes);
    }
}
