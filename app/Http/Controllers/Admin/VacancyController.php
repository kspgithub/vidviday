<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use App\Models\Staff;
use Illuminate\Http\Request;

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
            'vacancies'=>$vacancies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $staffs = Staff::toSelectBox('last_name');
        $vacancy = new Vacancy();

        return view('admin.vacancy.create', [
            'vacancy'=>$vacancy,
            'staffs'=>$staffs
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

        return redirect()->route('admin.vacancy.index')->withFlashSuccess(__('Vacancy created.'));
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

        $staffs = Staff::toSelectBox('last_name');
        return view('admin.vacancy.edit', [
            'vacancy' => $vacancy,
            'staffs' => $staffs
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Vacancy $vacancy
     *
     * @return Response
     */
    public function update(Request $request, Vacancy $vacancy)
    {

        //
        $vacancy->fill($request->all());
        $vacancy->save();

        return redirect()->route('admin.vacancy.index')->withFlashSuccess(__('Vacancy updated.'));
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

        return redirect()->route('admin.vacancy.index')->withFlashSuccess(__('Region deleted.'));
    }

}
