<?php

namespace App\Http\Controllers\Admin\EventItem;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventItemBasicRequest;
use App\Models\Direction;
use App\Models\Event;
use App\Models\EventGroup;
use App\Models\EventItem;
use App\Services\EventItemService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EventItemController extends Controller
{
    protected $service;

    public function __construct(EventItemService $service)
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
        $eventItems = EventItem::query()->withCount('media')->paginate(20);

        return view('admin.event-item.index', compact('eventItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $eventItem = new EventItem();

        $eventGroups  = EventGroup::toSelectBox('title', 'id');

        $directions  = Direction::toSelectBox('title', 'id');

        $events  = Event::toSelectBox('title', 'id');

        return view('admin.event-item.create', [
            "eventItem" => $eventItem,
            "eventGroups" => $eventGroups,
            "directions" => $directions,
            "events" => $events,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EventItemBasicRequest $request
     *
     * @return mixed
     */
    public function store(EventItemBasicRequest $request)
    {
        $this->service->store($request->validated());

        return redirect()->route('admin.event-item.index')->withFlashSuccess(__('Record Created'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param EventItem $eventItem
     *
     * @return Application|Factory|View
     */
    public function edit(EventItem $eventItem)
    {
        $eventGroups  = EventGroup::toSelectBox('title', 'id');

        $directions  = Direction::toSelectBox('title', 'id');

        $events  = Event::toSelectBox('title', 'id');

        return view('admin.event-item.edit', [
            "eventItem" => $eventItem,
            "eventGroups" => $eventGroups,
            "directions" => $directions,
            "events" => $events,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EventItemBasicRequest $request
     *
     * @param EventItem $eventItem
     *
     * @return mixed
     *
     * @throws GeneralException
     */
    public function update(EventItemBasicRequest $request, EventItem $eventItem)
    {

        $this->service->update($eventItem, $request->validated());

        return redirect()->route('admin.event-item.index', $eventItem)->withFlashSuccess(__('Record updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EventItem $eventItem
     *
     * @return mixed
     */
    public function destroy(EventItem $eventItem)
    {
        $eventItem->delete();

        return redirect()->route('admin.event-item.index')->withFlashSuccess(__('Record deleted.'));
    }


    /**
     * @param EventItem $eventItem
     *
     * @return Application|Factory|View
     */
    public function mediaIndex(EventItem $eventItem)
    {
        return view('admin.event-item.media', compact('eventItem'));
    }
}
