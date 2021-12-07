<?php

namespace App\Http\Controllers\Admin\TourSubjects;

use App\Http\Controllers\Controller;
use App\Models\TourSubject;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\SlugOptions;

class TourSubjectsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $tourSubjects = TourSubject::query()->withCount(['media'])->get();
        //
        return view('admin.tour_subjects.index', ['tourSubjects'=>$tourSubjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $tourSubject = new TourSubject();

        return view('admin.tour_subjects.create', ['tourSubject'=>$tourSubject]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $tourSubject = new TourSubject();
        $tourSubject->fill($request->all());
        $tourSubject->save();

        return redirect()->route('admin.tour-subjects.index')->withFlashSuccess(__('Tour Subject created.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TourSubject $tourSubject
     *
     * @return View
     */
    public function edit(TourSubject $tourSubject)
    {
        //
        return view('admin.tour_subjects.edit', ['tourSubject'=>$tourSubject]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TourSubject $tourSubject
     *
     * @return Response|JsonResponse
     */
    public function update(Request $request, TourSubject $tourSubject)
    {
        //
        $tourSubject->fill($request->all());
        $tourSubject->save();
        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Record Updated')]);
        }
        return redirect()->route('admin.tour-subjects.index')->withFlashSuccess(__('Tour Subject updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TourSubject $tourSubject
     *
     * @return Response
     */
    public function destroy(TourSubject $tourSubject)
    {
        //
        $tourSubject->delete();

        return redirect()->route('admin.tour-subjects.index')->withFlashSuccess(__('Tour Subject deleted.'));
    }

}
