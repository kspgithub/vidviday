<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
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
            $search = $request->input('q', '');

            if (!empty($search)) {
                $query
                    ->whereRaw("CONCAT_WS(' ', last_name, first_name) LIKE '%$search%'")
                    ->orWhereRaw("phone LIKE '%$search%'")
                    ->orWhereRaw("email LIKE '%$search%'");
            }

            $order = explode(':', $request->input('order', 'bitrix_id:asc'));
            $query->orderBy($order[0] ?? 'bitrix_id', $order[1] ?? 'asc');

            return $query->paginate($request->input('per_page', 20));
        }

        return view('admin.crm.client.index');
    }


    public function show(Request $request, BitrixContact $client)
    {
        if ($request->ajax()) {
            $orderQ = $client->orders()->filter($request)->with(['tour', 'tour.manager', 'schedule']);

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
            'managers' => $managers,
            'statuses' => $statuses,
            'tours' => $tours,
        ]);

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
