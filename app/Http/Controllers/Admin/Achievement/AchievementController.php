<?php

namespace App\Http\Controllers\Admin\Achievement;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        $achievements = Achievement::query()->orderBy('position')->get();
        return view('admin.achievement.index', ['achievements'=>$achievements]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $achievement = new Achievement();
        return view('admin.achievement.create', ['achievement'=>$achievement]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'image_upload' => ['nullable', 'file', 'max:500']
        ]);
        $achievement = new Achievement();
        $achievement->fill($request->all());
        $achievement->save();
        if ($request->hasFile('image_upload')) {
            $achievement->uploadImage($request->file('image_upload'));
        }
        return redirect()->route('admin.achievement.edit', $achievement)->withFlashSuccess(__('Record Created'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  Achievement $achievement
     * @return View
     */
    public function edit(Achievement $achievement)
    {
        //
        return view('admin.achievement.edit', ['achievement'=>$achievement]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Achievement $achievement
     * @return Response
     */
    public function update(Request $request, Achievement $achievement)
    {
        $this->validate($request, [
            'image_upload' => ['nullable', 'file', 'max:500']
        ]);
        $achievement->fill($request->all());
        $achievement->save();
        if ($request->hasFile('image_upload')) {
            $achievement->uploadImage($request->file('image_upload'));
        }
        return redirect()->route('admin.achievement.edit', $achievement)->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Achievement $achievement
     * @return Response
     */
    public function destroy(Achievement $achievement)
    {
        //
        $achievement->deleteImage();
        $achievement->delete();
        return redirect()->route('admin.achievement.index')->withFlashSuccess(__('Record Deleted'));
    }
}
