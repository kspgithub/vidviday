<?php

namespace App\Lib\Bitrix24\CRM\Contact;

use App\Lib\Bitrix24\Core\HasAttributes;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

/**
 * @property string $id
 * @property string $name
 * @property string $last_name
 * @property array $phone
 * @property array $email
 * @property array $im
 */
class ContactItem implements Arrayable, Jsonable
{
    use HasAttributes;


    public function __construct($attributes = [])
    {
        $this->fill($attributes);
    }

    protected $fillable = [
        'id',
        'name',
        'last_name',
        'phone',
        'email',
        'im',
    ];

    public function addPhone($value, $type = ContactValue::CONTACT_TYPE_MOBILE)
    {
        $phones = $this->phone || [];
        $phones[] = new ContactValue([
            'value' => $value,
            'value_type' => $type,
        ]);
        $this->setAttribute('phone', $phones);
    }

    public function addEmail($value, $type = ContactValue::CONTACT_TYPE_HOME)
    {
        $emails = $this->email || [];
        $emails[] = new ContactValue([
            'value' => $value,
            'value_type' => $type,
        ]);
        $this->email = $emails;
    }

    public function addIm($value, $type = '')
    {
        $im = $this->im || [];
        $im[] = new ContactValue([
            'value' => $value,
            'value_type' => $type,
        ]);
        $this->im = $im;
    }
}
