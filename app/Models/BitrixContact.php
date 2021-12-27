<?php

namespace App\Models;

use App\Lib\Bitrix24\CRM\Contact\ContactService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BitrixContact extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'bitrix_id',
        'first_name',
        'last_name',
        'email',
        'phone',
    ];


    protected $casts = [
        'email' => 'array',
        'phone' => 'array',
    ];


    public static function createOrUpdate($bitrix_id, $contactData = [])
    {
        $bitrixContact = self::whereBitrixId($bitrix_id)->first();
        if ($bitrixContact === null) {
            $bitrixContact = new self();
            $bitrixContact->bitrix_id = $bitrix_id;
        }

        $bitrixContact->first_name = $contactData['NAME'] ?? '';
        $bitrixContact->last_name = $contactData['LAST_NAME'] ?? '';

        $phones = $bitrixContact->phone ?? [];
        if (isset($contactData['PHONE'])) {
            foreach ($contactData['PHONE'] as $phoneData) {
                $phones[] = trim($phoneData['VALUE']);
                $phones[] = preg_replace('/[^0-9]/', '', $phoneData['VALUE']);
            }
        }
        $bitrixContact->phone = array_filter(array_unique($phones));


        $emails = $bitrixContact->email ?? [];
        if (isset($contactData['EMAIL'])) {
            foreach ($contactData['EMAIL'] as $emailData) {
                $emails[] = trim($emailData['VALUE']);
            }
        }
        $bitrixContact->email = array_filter(array_unique($emails));
        $bitrixContact->save();
    }

    public static function findByPhone($phone)
    {

    }
}
