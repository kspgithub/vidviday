<?php

namespace App\Http\Controllers\Admin\Event;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventBasicRequest;
use App\Models\Direction;
use App\Models\EventGroup;
use App\Models\EventItem;
use App\Models\Tour;
use App\Services\EventService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
        $event = new EventItem();
        $directions = Direction::toSelectBox();
        $groups = EventGroup::toSelectBox();
        $tours = Tour::toSelectBox();

        return view('admin.event.create', [
            'event' => $event,
            'directions' => $directions,
            'groups' => $groups,
            'tours' => $tours,
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
        return redirect()->route('admin.event.edit', $event)->withFlashSuccess(__('Record Created'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param EventItem $event
     *
     * @return Application|Factory|View
     */
    public function edit(EventItem $event)
    {
        $directions = Direction::toSelectBox();
        $groups = EventGroup::toSelectBox();
        $tours = Tour::toSelectBox();

        return view('admin.event.edit', [
            'event' => $event,
            'directions' => $directions,
            'groups' => $groups,
            'tours' => $tours,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EventBasicRequest $request
     *
     * @param EventItem $event
     *
     * @return mixed
     *
     * @throws GeneralException
     */
    public function update(EventBasicRequest $request, EventItem $event)
    {
        $this->service->update($event, $request->validated());
        return redirect()->route('admin.event.edit', $event)->withFlashSuccess(__('Record Updated'));
    }


    public function updateStatus(Request $request, EventItem $event)
    {
        if ($request->has('published')) {
            $event->published = $request->published;
            $event->save();
            return response()->json(['result' => 'success']);
        }
        return response()->json(['result' => 'error']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param EventItem $event
     *
     * @return mixed
     */
    public function destroy(EventItem $event)
    {
        $event->delete();

        return redirect()->route('admin.event.index')->withFlashSuccess(__('Record Deleted'));
    }
}
