<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventGroup;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EventGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Event $event
     *
     * @return Application|Factory|View
     */
    public function index(Event $event)
    {
        $options = EventGroup::toSelectBox();

        $selected_ids = $event->groups()->pluck('id')->toArray();

        return view('admin.event.groups', [
            'event'=>$event,
            'options'=>$options,
            'selected_ids'=>$selected_ids,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @param Event $event
     *
     * @return mixed
     */
    public function update(Request $request, Event $event)
    {
        $event->groups()->sync($request->input('groups', []));

        return redirect()->back()->withFlashSuccess(__('Record updated.'));
    }
}
