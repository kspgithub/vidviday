<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    //

    /**
     * Поиск мест по названию (select box)
     *
     * @param  Request  $request
     * @return mixed
     */
    public function selectBox(Request $request)
    {
        $q = $request->input('q', '');
        $region_id = (int) $request->input('region_id', 0);
        $query = Ticket::query();

        if ($region_id > 0) {
            $query->where('region_id', $region_id);
        }
        $paginator = $query->autocomplete($q)->paginate($request->input('limit', 10));
        $items = [];
        foreach ($paginator->items() as $item) {
            $items[] = $item->asSelectBox();
        }

        return [
            'results' => $items,
            'pagination' => [
                'more' => $paginator->hasMorePages(),
            ],
        ];
    }

    public function get(Request $request)
    {
        $place_id = (int) $request->input('ticket_id', 0);

        $place = Ticket::query()->findOrFail($place_id);

        return response()->json($place);
    }
}
