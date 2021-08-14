<?php

namespace App\Http\Controllers\Admin\EventGroup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventGroupBasicRequest;
use App\Models\EventGroup;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class EventGroupController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $eventGroups = EventGroup::query()->withCount('media')->paginate(20);

        return view('admin.event-group.index', compact('eventGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {

        $eventGroup = new EventGroup();

        return view('admin.event-group.create', compact('eventGroup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EventGroupBasicRequest $request
     *
     * @return mixed
     */
    public function store(EventGroupBasicRequest $request)
    {
        $eventGroup = new EventGroup();

        $eventGroup->fill($request->all());
        $eventGroup->save();

        return redirect()->route('admin.event-group.index')->withFlashSuccess(__('Record Created'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param EventGroup $eventGroup
     *
     * @return Application|Factory|View
     */
    public function edit(EventGroup $eventGroup)
    {
        return view('admin.event-group.edit', compact('eventGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EventGroupBasicRequest $request
     *
     * @param EventGroup $eventGroup
     *
     * @return mixed
     */
    public function update(EventGroupBasicRequest $request, EventGroup $eventGroup)
    {
        $eventGroup->fill($request->all());
        $eventGroup->save();

        return redirect()->route('admin.event-group.index')->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EventGroup $eventGroup
     *
     * @return mixed
     */
    public function destroy(EventGroup $eventGroup)
    {
        $eventGroup->delete();

        return redirect()->route('admin.event-group.index')->withFlashSuccess(__('Record Deleted'));
    }

    /**
     * @param EventGroup $eventGroup
     *
     * @return Application|Factory|View
     */
    public function mediaIndex(EventGroup $eventGroup)
    {
        return view('admin.event-group.media', compact('eventGroup'));
    }
}
