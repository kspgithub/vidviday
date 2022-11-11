<?php

namespace App\Http\Controllers\Admin\Accommodation;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $items = Accommodation::all();

        return view('admin.accommodation.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $countries = Country::toSelectBox('title', 'id');
        $regions = Region::toSelectBox('title', 'id');
        $accommodation = new Accommodation();

        return view('admin.accommodation.create', [
            'accommodation' => $accommodation,
            'countries' => $countries,
            'regions' => $regions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'array'],
            'title.uk' => ['required', 'max:100'],
            //            'title_where' => ['required', 'array'],
            //            'title_where.uk' => ['required', 'max:100'],
            'text' => ['required', 'array'],
            'text.uk' => ['nullable', 'max:500'],
            'country_id' => ['nullable', 'integer'],
            'region_id' => ['nullable', 'integer'],
            'city_id' => ['nullable', 'integer'],
            'published' => ['nullable', 'integer', Rule::in([0, 1])],
        ]);

        $accommodation = new Accommodation();
        $accommodation->fill($request->all());
        $accommodation->save();

        return redirect()->route('admin.accommodation.edit', $accommodation)->withFlashSuccess(__('Record Created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Accommodation  $accommodation
     * @return View
     */
    public function edit(Accommodation $accommodation)
    {
        $countries = Country::toSelectBox('title', 'id');
        $regions = Region::toSelectBox('title', 'id');

        return view('admin.accommodation.edit', [
            'accommodation' => $accommodation,
            'countries' => $countries,
            'regions' => $regions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Accommodation  $accommodation
     * @return Response
     */
    public function update(Request $request, Accommodation $accommodation)
    {
        $request->validate([
            'title' => ['required', 'array'],
            'title.uk' => ['required', 'max:100'],
            //            'title_where' => ['required', 'array'],
            //            'title_where.uk' => ['required', 'max:100'],
            'text' => ['required', 'array'],
            'text.uk' => ['nullable', 'max:500'],
            'country_id' => ['nullable', 'integer'],
            'region_id' => ['nullable', 'integer'],
            'city_id' => ['nullable', 'integer'],
            'published' => ['nullable', 'integer', Rule::in([0, 1])],
        ]);

        $accommodation->fill($request->all());
        $accommodation->save();

        return redirect()->route('admin.accommodation.index')->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Accommodation  $accommodation
     * @return Response
     */
    public function destroy(Accommodation $accommodation)
    {
        //
        $accommodation->delete();

        return redirect()->route('admin.accommodation.index')->withFlashSuccess(__('Record Deleted'));
    }

    /**
     * Update the specified resource status.
     *
     * @param  Request  $request
     * @param  Accommodation  $accommodation
     * @return JsonResponse
     */
    public function updateStatus(Request $request, Accommodation $accommodation)
    {
        $request->validate([
            'published' => ['nullable', 'integer', Rule::in([0, 1])],
        ]);
        $accommodation->published = (int) $request->published;
        $accommodation->save();

        return response()->json(['result' => 'success']);
    }
}
