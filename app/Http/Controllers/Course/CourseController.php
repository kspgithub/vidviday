<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //

    public function index()
    {
        $pageContent = Page::where('key', 'courses')->first();
        $courses = Course::published()->orderBy('created_at', 'desc')->paginate(20);
        return view('course.index', [
            'pageContent'=>$pageContent,
            'courses'=>$courses,
        ]);
    }

    public function show($slug)
    {
        $pageContent = Page::where('key', 'courses')->first();
        $course = Course::findBySlugOrFail($slug);
        return view('course.show', [
            'pageContent'=>$pageContent,
            'course'=>$course,
        ]);
    }


}
