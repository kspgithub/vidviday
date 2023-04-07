<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CRM\StoreClientRequest;
use App\Models\BitrixContact;
use App\Models\Order;
use App\Models\Staff;
use App\Models\Tour;
use Illuminate\Http\Request;

class CrmClientController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = BitrixContact::query();

            $contact = $request->input('contact', '');
            if (!empty($contact)) {
                $query->whereRaw("CONCAT_WS(' ', last_name, first_name) LIKE '%$contact%'");
            }
            
            $phone = $request->input('phone', '');
            if (!empty($phone)) {
                $query->whereRaw("JSON_CONTAINS(phone, '\"$phone\"', '$')");
            }
            
            $email = $request->input('email', '');
            if (!empty($email)) {
                $query->whereRaw("JSON_CONTAINS(email, '\"$email\"', '$')");
            }
            
            $bitrix_id = $request->input('bitrix_id', 0);
            if (!empty($bitrix_id)) {
                $query->where('bitrix_id', $bitrix_id);
            }

            $order = explode(':', $request->input('order', 'bitrix_id:asc'));
            $query->orderBy($order[0] ?? 'bitrix_id', $order[1] ?? 'asc');

            return $query->paginate($request->input('per_page', 20));
        }

        return view('admin.crm.client.index');
    }


    public function show(Request $request, BitrixContact $client, $type = 'team')
    {
        $group_type = $type === 'corporate' ? Order::GROUP_CORPORATE : Order::GROUP_TEAM;

        if ($request->ajax()) {

            $orderQ = $client->orders()->where('group_type', $group_type)->filter($request)->with(['tour', 'tour.manager', 'schedule']);

            $paginator = $orderQ->paginate($request->input('per_page', 20));
            $paginator->getCollection()->transform(function ($val) {
                $val->makeVisible([
                    'duty_comment',
                    'admin_comment',
                    'agency_data',
                ]);
                return $val;
            });

            return response()->json($paginator);
        }
        $managers = Staff::onlyTourManagers()->get()->map->asSelectBox();
        $statuses = arrayToSelectBox(Order::statuses());
        $tours = Tour::toSelectBox();
        return view('admin.crm.client.show', [
            'client' => $client,
            'group_type' => $group_type,
            'managers' => $managers,
            'statuses' => $statuses,
            'tours' => $tours,
        ]);
    }

    public function store(StoreClientRequest $request)
    {
        $client = new BitrixContact();
        $client->fill($request->validated());
        $client->save();
        return response()->json(['result' => 'success', 'message' => __('Record Created')]);
    }

    public function update(Request $request, BitrixContact $client)
    {
        $client->fill($request->all());
        $client->save();
        return response()->json(['result' => 'success', 'message' => __('Record Updated')]);
    }

    public function delete(BitrixContact $client)
    {
        $client->delete();
        return response()->json(['result' => 'success', 'message' => __('Record Deleted')]);
    }

}
