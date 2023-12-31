<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CountryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {

        $countries = Country::query()->orderBy('position')->orderBy('title')->get();

        return view('admin.country.index', ['countries' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $country = new Country();
        return view('admin.country.create', ['country' => $country]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response|RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $request->has('published') ? [] : [
            'title' => 'required|array',
            'title.uk' => 'required|string',
            'iso' => 'required|string|max:10|unique:countries',
            'slug' => 'required|string|max:10|unique:countries',
            'phone_code' => 'required',
            'phone_mask' => 'required',
            'phone_rule' => 'required|regex:/^\/(.*)\/$/',
        ]);
        // Failed
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors()->toArray());
        }

        $country = new Country();
        $country->fill($request->all());
        $country->save();

        return redirect()->route('admin.country.index')->withFlashSuccess(__('Record Created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Country $country
     *
     * @return View
     */
    public function edit(Country $country)
    {
        return view('admin.country.edit', [
            'country' => $country
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Country $country
     *
     * @return Response|RedirectResponse|JsonResponse
     */
    public function update(Request $request, Country $country)
    {
        $validator = Validator::make($request->all(), $request->has('published') ? [] : [
            'title' => 'required|array',
            'title.uk' => 'required|string',
            'iso' => 'required|string|max:10|unique:countries,iso,' . $country->id,
            'slug' => 'required|string|max:10|unique:countries,slug,' . $country->id,
            'phone_code' => 'required',
            'phone_mask' => 'required',
            'phone_rule' => 'required|regex:/^\/(.*)\/$/',
        ]);
        // Failed
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors()->toArray());
        }
        //
        $country->fill($request->all());
        $country->save();

        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Record Updated')]);
        }

        return redirect()->route('admin.country.index')->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Country $country
     *
     * @return Response
     */
    public function destroy(Country $country)
    {
        //
        $country->delete();

        return redirect()->route('admin.country.index')->withFlashSuccess(__('Record Deleted'));
    }


    public function sort(Request $request)
    {
        $ids = $request->input('order', []);
        foreach ($ids as $position => $id) {
            Country::whereId($id)->update(['position' => $position]);
        }

        return response()->json(['result' => 'success', 'message' => __('Record Updated')]);
    }
}
