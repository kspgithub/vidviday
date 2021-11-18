<?php

namespace App\Http\Controllers\Admin\Vacancy;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use App\Models\Staff;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $vacancies = Vacancy::query()->paginate(20);

        return view('admin.vacancy.index', [
            'vacancies' => $vacancies
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
        $vacancies = Vacancy::toSelectBox();
        $vacancy = new Vacancy();

        return view('admin.vacancy.create', [
            'vacancy' => $vacancy,
            'staffs' => $staffs,
            'vacancies' => $vacancies,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $vacancy = new Vacancy();
        $vacancy->fill($request->all());
        $vacancy->save();

        return redirect()->route('admin.vacancy.edit', $vacancy)->withFlashSuccess(__('Record Created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Vacancy $vacancy
     *
     * @return View
     */
    public function edit(Vacancy $vacancy)
    {

        $staffs = Staff::toSelectBox();
        $vacancies = Vacancy::where('id', '<>', $vacancy->id)->toSelectBox();
        return view('admin.vacancy.edit', [
            'vacancy' => $vacancy,
            'staffs' => $staffs,
            'vacancies' => $vacancies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Vacancy $vacancy
     *
     * @return Response|JsonResponse
     */
    public function update(Request $request, Vacancy $vacancy)
    {

        //
        $vacancy->fill($request->all());
        $vacancy->save();
        if ($request->ajax()) {
            return response()->json(['result' => 'success']);
        }

        return redirect()->route('admin.vacancy.edit', $vacancy)->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Vacancy $vacancy
     *
     * @return Response
     */
    public function destroy(Vacancy $vacancy)
    {
        //

        $vacancy->delete();

        return redirect()->route('admin.vacancy.index')->withFlashSuccess(__('Record Deleted'));
    }
}
