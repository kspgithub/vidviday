<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\TicketBasicRequest;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $service;

    public function __construct(TicketService $service)
    {
        $this->service = $service;
    }
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view("admin.ticket.index");
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $ticket = new Ticket();

        return view("admin.ticket.create",[
            "ticket" => $ticket
        ]);
    }

    /**
     * @param TicketBasicRequest $request
     * @return mixed
     */
    public function store(TicketBasicRequest $request)
    {
        $ticket = $this->service->store($request->validated());

        return redirect()->route('admin.ticket.index',["ticket" => $ticket])->withFlashSuccess(__('Ticket created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * @param Ticket $ticket
     * @return Application|Factory|View
     */
    public function edit(Ticket $ticket)
    {
        return view('admin.ticket.edit', [
            'ticket'=> $ticket
        ]);
    }

    /**
     * @param TicketBasicRequest $request
     * @param Ticket $ticket
     * @return mixed
     * @throws GeneralException
     */
    public function update(TicketBasicRequest $request, Ticket $ticket)
    {
        $this->service->update($ticket, $request->validated());

        return redirect()->route('admin.ticket.index', $ticket)->withFlashSuccess(__('Ticket updated.'));
    }

    /**
     * @param Ticket $ticket
     * @return mixed
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('admin.ticket.index')->withFlashSuccess(__('Ticket deleted.'));
    }
}
