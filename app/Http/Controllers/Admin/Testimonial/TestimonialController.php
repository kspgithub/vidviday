<?php

namespace App\Http\Controllers\Admin\Testimonial;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Testimonial;
use App\Models\TourQuestion;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestimonialController extends Controller
{
    //

    public function index()
    {
        return view('admin.testimonial.index');
    }

    public function questions()
    {
        return view('admin.testimonial.questions');
    }

    /**
     * @return View
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.edit', ['testimonial' => $testimonial]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $testimonial->fill($request->all());
        $testimonial->save();

        return redirect()->route('admin.testimonial.edit', $testimonial)->withFlashSuccess(__('Відгук оновлено'));
    }

    /**
     * @return View
     */
    public function editQuestion(TourQuestion $testimonial)
    {
        return view('admin.testimonial.edit-question', ['testimonial' => $testimonial]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function updateQuestion(Request $request, TourQuestion $testimonial)
    {
        $testimonial->fill($request->all());
        $testimonial->save();

        return redirect()->route('admin.testimonial.questions.edit', $testimonial)->withFlashSuccess(__('Відгук оновлено'));
    }
}
