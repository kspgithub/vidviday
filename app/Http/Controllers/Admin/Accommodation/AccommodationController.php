<?php

namespace App\Http\Controllers\Admin\Accommodation;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
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
        //
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
        //
        $accommodation = new Accommodation();
        return view('admin.accommodation.create', ['accommodation' => $accommodation]);
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
        $request->validate([
            'title' => ['required', 'max:100'],
            'text' => ['required', 'max:500'],
            'published' => ['nullable', 'integer', Rule::in([0, 1])],
        ]);

        $accommodation = new Accommodation();
        $accommodation->fill($request->only(['title', 'text', 'published']));
        $accommodation->save();
        return redirect()->route('admin.accommodation.edit', $accommodation)->withFlashSuccess(__('Record Created'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Accommodation $accommodation
     * @return View
     */
    public function edit(Accommodation $accommodation)
    {
        //
        return view('admin.accommodation.edit', ['accommodation' => $accommodation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Accommodation $accommodation
     * @return Response
     */
    public function update(Request $request, Accommodation $accommodation)
    {
        $request->validate([
            'title' => ['required', 'max:100'],
            'text' => ['required', 'max:500'],
            'published' => ['nullable', 'integer', Rule::in([0, 1])],
        ]);

        $accommodation->fill($request->only(['title', 'text', 'published']));
        $accommodation->save();
        return redirect()->route('admin.accommodation.index')->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Accommodation $accommodation
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
     * @param Request $request
     * @param Accommodation $accommodation
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
