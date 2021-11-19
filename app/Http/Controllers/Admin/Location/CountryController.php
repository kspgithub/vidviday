<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $countriesPrepeared = Country::query();
        $countriesPaginated = $countriesPrepeared->paginate(20);
        $countries = $countriesPrepeared->get();//->sortBy('region_id');

        //
        return view('admin.country.index', ['countries'=>$countries, 'countriesPaginated'=>$countriesPaginated]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $country = new Country();
        return view('admin.country.create', ['country'=>$country]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse
     */
    public function show(Country $country)
    {
        return redirect("admin/country/".$country->pluck('slug')[0]."/edit");
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',//*
            'iso' => 'required|string|max:10|regex:/(^([a-zA-Z]+)?$)/u',//*
            'slug' => 'required|string|max:100|regex:/(^([a-zA-Z]+)?$)/u',//*
        ]);
        // Failed
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors()->toArray());
        }

        $country = new Country();
        $country->title = $request->get('title');
        $country->iso = $request->get('iso');
        $country->slug = mb_strtolower($request->get('slug'), "UTF-8");
        $country->save();

        return redirect()->route('admin.country.index')->withFlashSuccess(__('Country created.'));
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
     * @return Response
     */
    public function update(Request $request, Country $country)
    {

        //
        $country->fill($request->all());
        $country->save();

        return redirect()->route('admin.country.index')->withFlashSuccess(__('Country updated.'));
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

        return redirect()->route('admin.country.index')->withFlashSuccess(__('Country deleted.'));
    }

}
