<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Staff;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $courses = Course::query()->paginate(20);

        return view('admin.course.index', [
            'courses' => $courses,
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
        $courses = Course::toSelectBox();
        $course = new Course();

        return view('admin.course.create', [
            'course' => $course,
            'staffs' => $staffs,
            'courses' => $courses,
        ]);
    }

    /**
     * @param Request  $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $course = new Course();
        $course->fill($request->all());
        $course->save();

        return redirect()->route('admin.course.edit', $course)->withFlashSuccess(__('Record Created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Course  $course
     *
     * @return View
     */
    public function edit(Course $course)
    {
        $staffs = Staff::toSelectBox();
        $courses = Course::where('id', '<>', $course->id)->toSelectBox();

        return view('admin.course.edit', [
            'course' => $course,
            'staffs' => $staffs,
            'courses' => $courses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request  $request
     * @param Course  $course
     *
     * @return Response|JsonResponse
     */
    public function update(Request $request, Course $course)
    {
        //
        $course->fill($request->all());
        $course->save();
        if ($request->ajax()) {
            return response()->json(['result' => 'success']);
        }

        return redirect()->route('admin.course.edit', $course)->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course  $course
     *
     * @return Response
     */
    public function destroy(Course $course)
    {
        //

        $course->delete();

        return redirect()->route('admin.course.index')->withFlashSuccess(__('Record Deleted'));
    }
}
