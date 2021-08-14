<?php

namespace App\Http\Controllers\Admin\Event;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventBasicRequest;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class EventController extends Controller
{
    protected $service;

    public function __construct(EventService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.event.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $event = new Event();

        return view('admin.event.create', [
            'event' => $event,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EventBasicRequest $request
     *
     * @return mixed
     */
    public function store(EventBasicRequest $request)
    {
        $event = $this->service->store($request->validated());

        return redirect()->route('admin.event.picture.index', ['event'=> $event])
                         ->withFlashSuccess(__('Record created.'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     *
     * @return Application|Factory|View
     */
    public function edit(Event $event)
    {

        return view('admin.event.edit', [
            'event' => $event,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EventBasicRequest $request
     *
     * @param Event $event
     *
     * @return mixed
     *
     * @throws GeneralException
     */
    public function update(EventBasicRequest $request, Event $event)
    {
        $this->service->update($event, $request->validated());

        return redirect()->route('admin.event.edit', $event)->withFlashSuccess(__('Record updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     *
     * @return mixed
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.event.index')->withFlashSuccess(__('Record deleted.'));
    }
}
