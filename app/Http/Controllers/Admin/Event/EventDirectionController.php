<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\Event;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EventDirectionController extends Controller
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
        $options = Direction::toSelectBox();

        $selected_ids = $event->directions()->pluck('id')->toArray();

        return view('admin.event.directions', [
            'event' => $event,
            'options' => $options,
            'selected_ids' => $selected_ids,
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
        $event->directions()->sync($request->input('directions', []));

        return redirect()->back()->withFlashSuccess(__('Event record updated.'));
    }
}
