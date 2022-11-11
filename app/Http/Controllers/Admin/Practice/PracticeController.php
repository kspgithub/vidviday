<?php

namespace App\Http\Controllers\Admin\Practice;

use App\Http\Controllers\Controller;
use App\Models\Practice;
use App\Models\Staff;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PracticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $practices = Practice::query()->paginate(20);

        return view('admin.practice.index', [
            'practices' => $practices,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $staffs = Staff::toSelectBox();
        $practices = Practice::toSelectBox();
        $practice = new Practice();

        return view('admin.practice.create', [
            'practice' => $practice,
            'staffs' => $staffs,
            'practices' => $practices,
        ]);
    }

    /**
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $practice = new Practice();
        $practice->fill($request->all());
        $practice->save();

        return redirect()->route('admin.practice.edit', $practice)->withFlashSuccess(__('Record Created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Practice  $practice
     * @return View
     */
    public function edit(Practice $practice)
    {
        $staffs = Staff::toSelectBox();
        $practices = Practice::where('id', '<>', $practice->id)->toSelectBox();

        return view('admin.practice.edit', [
            'practice' => $practice,
            'staffs' => $staffs,
            'practices' => $practices,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Practice  $practice
     * @return Response|JsonResponse
     */
    public function update(Request $request, Practice $practice)
    {
        //
        $practice->fill($request->all());
        $practice->save();
        if ($request->ajax()) {
            return response()->json(['result' => 'success']);
        }

        return redirect()->route('admin.practice.edit', $practice)->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Practice  $practice
     * @return Response
     */
    public function destroy(Practice $practice)
    {
        //

        $practice->delete();

        return redirect()->route('admin.practice.index')->withFlashSuccess(__('Record Deleted'));
    }
}
