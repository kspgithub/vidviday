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
        $pageContent = Page::published()->where('key', 'courses')->firstOrFail();
        $courses = Course::published()->orderBy('created_at', 'desc')->paginate(20);
        return view('course.index', [
            'pageContent'=>$pageContent,
            'courses'=>$courses,
        ]);
    }

    public function show($slug)
    {
        $pageContent = Page::published()->where('key', 'courses')->firstOrFail();
        $course = Course::findBySlugOrFail($slug);
        return view('course.show', [
            'pageContent'=>$pageContent,
            'course'=>$course,
        ]);
    }


}
