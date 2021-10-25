<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Lib\Bitrix24\CRM\Contact\ContactService;
use App\Models\BitrixContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CrmController extends Controller
{
    //

    public function contactUpdate(Request $request)
    {

        if (config('services.bitrix24.log-enable')) {
            Log::info('Contact Update', $request->all());
        }
        $event = $request->input('event', 'UNKNOWN');
        $data = $request->input('data', []);

        switch ($event) {
            case 'ONCRMCONTACTADD':
            case 'ONCRMCONTACTUPDATE':
                $bitrix_id = $data['FIELDS']['ID'];
                $response = ContactService::get($bitrix_id);
                if (!empty($response['result'])) {
                    BitrixContact::createOrUpdate($bitrix_id, $response['result']);
                }

                break;
        }

        return response()->json(['result' => 'OK']);
    }
}
