<?php

namespace App\Http\Controllers\Admin\Badge;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        $badges = Badge::all();

        return view('admin.badge.index', compact('badges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $badge = new Badge();

        return view('admin.badge.create', ['badge' => $badge]);
    }

    /**
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $badge = new Badge();
        $badge->fill($request->all());
        $badge->save();

        return redirect()->route('admin.badge.index')->withFlashSuccess(__('Badge created.'));
    }

    /**
     * @param  Badge  $badge
     * @return View
     */
    public function edit(Badge $badge)
    {
        //
        return view('admin.badge.edit', ['badge' => $badge]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Badge  $badge
     * @return Response
     */
    public function update(Request $request, Badge $badge)
    {
        //
        $badge->fill($request->all());
        $badge->save();

        return redirect()->route('admin.badge.index')->withFlashSuccess(__('Badge updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Badge  $badge
     * @return Response
     */
    public function destroy(Badge $badge)
    {
        //
        $badge->delete();

        return redirect()->route('admin.badge.index')->withFlashSuccess(__('Badge deleted.'));
    }
}
