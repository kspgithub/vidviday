<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Lib\Bitrix24\App\BusinessApp;
use App\Lib\Bitrix24\Core\CRest;
use App\Lib\Bitrix24\CRM\Contact\ContactService;
use App\Lib\Bitrix24\CRM\Deal\DealFields;
use App\Lib\Bitrix24\CRM\Deal\DealOrder;
use App\Lib\Bitrix24\CRM\Deal\DealService;
use App\Lib\Bitrix24\CRM\Dynamic\BitrixTour;
use App\Lib\Bitrix24\CRM\Dynamic\BitrixTourSchedule;
use App\Models\BitrixContact;
use App\Models\Order;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CrmController extends Controller
{
    //

    /**
     * Bitrix 24: Вихідний вебхук: Контакти - створення/оновлення/видалення - для сайту
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function contactUpdate(Request $request)
    {
        if (config('services.bitrix24.log-enable')) {
            Log::info('Contact Update', $request->all());
        }
        $event = $request->input('event', 'UNKNOWN');
        $data = $request->input('data', []);

        try {
            switch ($event) {
                case 'ONCRMCONTACTADD':
                case 'ONCRMCONTACTUPDATE':
                    $bitrix_id = $data['FIELDS']['ID'];
                    $response = ContactService::get($bitrix_id);
                    if (! $response->error) {
                        BitrixContact::createOrUpdate($bitrix_id, $response->result);
                    } else {
                        Log::error($response->error_description, (array) $response);
                    }
                    break;
                case 'ONCRMCONTACTDELETE':
                    $bitrix_id = $data['FIELDS']['ID'];
                    BitrixContact::whereBitrixId($bitrix_id)->delete();
                    break;
                default:
                    return response()->json(['result' => 'ERROR', 'message' => 'Unauthorized event '.$event], 403);
            }

            return response()->json(['result' => 'OK']);
        } catch (Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return response()->json(['result' => 'ERROR', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Bitrix 24: Вихідний вебхук: угода створення/оновлення/видалення - для сайту
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function dealUpdate(Request $request)
    {
        if (config('services.bitrix24.log-enable')) {
            Log::info('Deal Update', $request->all());
        }
        $event = $request->input('event', 'UNKNOWN');
        $data = $request->input('data', []);

        try {
            switch ($event) {
                case 'ONCRMDEALADD':
                case 'ONCRMDEALUPDATE':
                    $bitrix_id = $data['FIELDS']['ID'];
                    $response = DealService::get($bitrix_id);
                    if (! $response->error) {
                        switch ((int) $response->result[DealFields::FIELD_CATEGORY_ID]) {
                            case DealOrder::CATEGORY_ID:
                                DealOrder::createOrUpdate($bitrix_id, $response->result);
                                break;
                        }
                    } else {
                        Log::error($response->error_description, (array) $response);
                    }

                    break;
                case 'ONCRMDEALDELETE':
                    $bitrix_id = $data['FIELDS']['ID'];
                    $response = DealService::get($bitrix_id);
                    if (! $response->error) {
                        switch ((int) $response->result[DealFields::FIELD_CATEGORY_ID]) {
                            case DealOrder::CATEGORY_ID:
                                Order::whereBitrixId($bitrix_id)->delete();
                                break;
                        }
                    } else {
                        Log::error($response->error_description, (array) $response);
                    }
                    break;
                default:
                    return response()->json(['result' => 'ERROR', 'message' => 'Unauthorized event '.$event], 403);
            }

            return response()->json(['result' => 'OK']);
        } catch (Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return response()->json(['result' => 'ERROR', 'message' => $e->getMessage()]);
        }
    }

    public function appHandler(Request $request)
    {
        if (config('services.bitrix24.log-enable')) {
            Log::info('App Handler', $request->all());
        }

        $code = $request->input('code', '');

        if (! empty($code)) {
            $properties = $request->input('properties', []);
            $itemId = $properties['id'] ?? 0;
            if ($itemId > 0) {
                switch ($code) {
                    case 'TOUR_UPDATE':
                        $data = BitrixTour::get($itemId);
                        if (! empty($data)) {
                            BitrixTour::createOrUpdate($itemId, $data);
                        }
                        break;
                    case 'TOUR_SCHEDULE_UPDATE':
                        $data = BitrixTourSchedule::get($itemId);
                        if (! empty($data)) {
                            BitrixTourSchedule::createOrUpdate($itemId, $data);
                        }
                        break;
                }
            } else {
                Log::error('Invalid Properties', $properties);
            }
        }

        return response()->json(['result' => 'OK']);
    }

    public function appInstall(Request $request)
    {
        Log::info('App Install', $request->all());

        $result = CRest::installApp($request->all());
        if ($result['install']) {
            BusinessApp::registerActivity();
        }

        return response()->json($result);
    }

    public function appCheckServer(Request $request)
    {
        return response()->json(CRest::checkServer());
    }
}
