<?php

namespace App\Lib\Bitrix24\CRM\Contact;

use App\Lib\Bitrix24\Core\StaticServiceInterface;
use App\Lib\Bitrix24\Core\UseStaticService;
use App\Models\BitrixContact;

class ContactService implements StaticServiceInterface
{
    use UseStaticService;

    public static function apiBaseMethod(): string
    {
        return 'crm.contact';
    }

    public static function findByPhone($phone, $fields = ['ID', 'NAME', 'LAST_NAME', 'EMAIL', 'PHONE'])
    {
        $filter = [
            'PHONE' => $phone,
        ];
        $response = self::list($fields, $filter);

        return $response['result'];
    }

    public static function findByEmail($email, $fields = ['ID', 'NAME', 'LAST_NAME', 'EMAIL', 'PHONE'])
    {
        $filter = [
            'EMAIL' => $email,
        ];
        $result = self::list($fields, $filter);
    }

    public static function getContactId($data)
    {
        $query = BitrixContact::query()->where('id', '=', 0);
        if (! empty($data['phone'])) {
            $query->orWhereJsonContains('phone', $data['phone']);
            $query->orWhereJsonContains('phone', clear_phone($data['phone']));
        }
        if (! empty($data['email'])) {
            $query->orWhereJsonContains('email', $data['email']);
        }
        $contact = $query->first();

        if (! empty($contact)) {
            return $contact->bitrix_id;
        } else {
            $contact = new ContactItem([
                'name' => $data['name'] ?? '',
                'last_name' => $data['last_name'] ?? '',
            ]);
            if (! empty($data['phone'])) {
                $contact->addPhone($data['phone']);
            }
            if (! empty($data['email'])) {
                $contact->addEmail($data['email']);
            }
            if (! empty($data['viber'])) {
                $contact->addIm($data['viber']);
            }

            $contact_data = $contact->toArray();

            $response = self::add($contact_data, ['REGISTER_SONET_EVENT' => 'N']);
            if (! empty($response->result)) {
                return $response->result;
            }

            return null;
        }
    }
}
