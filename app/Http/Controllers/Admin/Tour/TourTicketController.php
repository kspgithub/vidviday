<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\Ticket;
use App\Models\Tour;
use App\Models\TourTicket;
use Illuminate\Http\Request;

class TourTicketController extends Controller
{
    //

    public function index(Tour $tour)
    {
        return view('admin.tour.tickets', ['tour' => $tour]);
    }

    public function create(Tour $tour)
    {
        $model = new TourTicket();
        $model->ticket_id = 0;
        $regions = Region::query()->orderBy('title')->toSelectBox();
        $tickets = Ticket::query()->with(['region'])->orderBy('region_id')->orderBy('slug')->toSelectBox();

        return view('admin.tour.tickets.create', [
            'model' => $model,
            'tour' => $tour,
            'regions' => $regions,
            'tickets' => $tickets,
        ]);
    }

    public function store(Request $request, Tour $tour)
    {
        $model = new TourTicket();
        $model->fill($request->all());
        $model->tour_id = $tour->id;
        if ((int)$model->ticket_id === 0) {
            $model->ticket_id = null;
        }
        $model->save();

        return redirect()->route('admin.tour.ticket.index', $tour)->withFlashSuccess(__('Record Created'));
    }

    public function edit(Tour $tour, TourTicket $model)
    {
        $regions = Region::query()->orderBy('title')->toSelectBox();
        $tickets = Ticket::query()->with(['region'])->orderBy('region_id')->orderBy('slug')->toSelectBox();

        return view('admin.tour.tickets.edit', [
            'model' => $model,
            'tour' => $tour,
            'regions' => $regions,
            'tickets' => $tickets,
        ]);
    }

    public function update(Request $request, Tour $tour, TourTicket $model)
    {
        $model->fill($request->all());
        $model->tour_id = $tour->id;
        if ((int)$model->ticket_id === 0) {
            $model->ticket_id = null;
        }
        $model->save();
        return redirect()->route('admin.tour.ticket.index', $tour)->withFlashSuccess(__('Record Updated'));
    }
}
