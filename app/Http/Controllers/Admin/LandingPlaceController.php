<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPlace;
use Illuminate\Http\Request;

class LandingPlaceController extends Controller
{
    public function index(Request $request)
    {
        //
        $items = LandingPlace::query()->paginate($request->input('per_page', 20));
        return view('admin.landing-place.index', ['items' => $items]);
    }

    public function create()
    {
        //
        $landingPlace = new LandingPlace();
        return view('admin.landing-place.create', ['model' => $landingPlace]);

    }

    public function store(Request $request)
    {
        //
        $landingPlace = new LandingPlace();
        $landingPlace->fill($request->all());
        $landingPlace->save();
        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Record Created'), 'model' => $landingPlace]);
        }
        return redirect()->route('admin.landing-place.index')->withFlashSuccess(__('Record Created'));
    }


    public function edit(LandingPlace $landingPlace)
    {
        //
        return view('admin.landing-place.edit', ['model' => $landingPlace]);
    }

    public function update(Request $request, LandingPlace $landingPlace)
    {
        //
        $landingPlace->fill($request->all());
        $landingPlace->save();
        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Record Updated'), 'model' => $landingPlace]);
        }
        return redirect()->route('admin.landing-place.index')->withFlashSuccess(__('Record Updated'));
    }

    public function destroy(Request $request, LandingPlace $landingPlace)
    {
        //
        $landingPlace->delete();
        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Record Deleted'), 'model' => $landingPlace]);
        }
        return redirect()->route('admin.landing-place.index')->withFlashSuccess(__('Record Deleted'));
    }
}
