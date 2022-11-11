<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\TicketBasicRequest;
use App\Models\Currency;
use App\Models\Region;
use App\Models\Ticket;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.ticket.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $ticket = new Ticket();

        $ticket->currency = 'UAH';

        $currencies = Currency::toSelectBox('iso', 'iso');
        $regions = Region::toSelectBox();

        return view('admin.ticket.create', [
            'ticket' => $ticket,
            'currencies' => $currencies,
            'regions' => $regions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TicketBasicRequest  $request
     * @return mixed
     */
    public function store(TicketBasicRequest $request)
    {
        $ticket = new Ticket();

        $ticket->fill($request->all());
        $ticket->save();

        return redirect()->route('admin.ticket.index', ['ticket' => $ticket])->withFlashSuccess(__('Record Created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Ticket  $ticket
     * @return Application|Factory|View
     */
    public function edit(Ticket $ticket)
    {
        $currencies = Currency::toSelectBox('iso', 'iso');
        $regions = Region::toSelectBox('title', 'id');

        return view('admin.ticket.edit', [
            'ticket' => $ticket,
            'currencies' => $currencies,
            'regions' => $regions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TicketBasicRequest  $request
     * @param  Ticket  $ticket
     * @return mixed
     *
     * @throws GeneralException
     */
    public function update(TicketBasicRequest $request, Ticket $ticket)
    {
        $ticket->fill($request->all());
        $ticket->save();

        return redirect()->route('admin.ticket.index', $ticket)->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Ticket  $ticket
     * @return mixed
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('admin.ticket.index')->withFlashSuccess(__('Record Deleted'));
    }

    /**
     * Update status the specified resource.
     *
     * @param  Request  $request
     * @param  Ticket  $ticket
     * @return JsonResponse
     */
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $ticket->published = (int) $request->input('published');
        $ticket->save();

        return response()->json(['result' => 'Success']);
    }
}
