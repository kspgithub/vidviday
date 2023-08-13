<?php

namespace App\Http\Controllers\Admin\Testimonial;

use App\Http\Controllers\Controller;
use App\Models\AgencySubscription;
use App\Models\Contact;
use App\Models\Testimonial;
use App\Models\TourQuestion;
use App\Models\UserQuestion;
use App\Models\UserSubscription;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\File;

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

    public function resume()
    {
        return view('admin.testimonial.resume');
    }

    public function userQuestions()
    {
        return view('admin.testimonial.user-questions');
    }

    public function userSubscriptions()
    {
        return view('admin.testimonial.user-subscriptions');
    }

    public function agencySubscriptions()
    {
        return view('admin.testimonial.agency-subscriptions');
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
     * @return View
     */
    public function editResume(UserQuestion $question)
    {
        return view('admin.testimonial.edit-resume', ['testimonial' => $question]);
    }

    /**
     * @return View
     */
    public function editUserQuestion(UserQuestion $testimonial)
    {
        return view('admin.testimonial.edit-user-question', ['testimonial' => $testimonial]);
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

    public function updateResume(Request $request, UserQuestion $question)
    {
        $question->fill($request->all());
        $question->save();

        return redirect()->route('admin.testimonial.resume.edit', $question)->withFlashSuccess(__('Резюме оновлено'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function updateUserQuestion(Request $request, UserQuestion $testimonial)
    {
        $testimonial->fill($request->all());
        $testimonial->save();

        return redirect()->route('admin.testimonial.user_questions.edit', $testimonial)->withFlashSuccess(__('Відгук оновлено'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function updateUserSubscription(Request $request, UserSubscription $testimonial)
    {
        $testimonial->fill($request->all());
        $testimonial->save();

        return redirect()->route('admin.testimonial.user_subscriptions.edit', $testimonial)->withFlashSuccess(__('Відгук оновлено'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function updateAgencySubscription(Request $request, AgencySubscription $testimonial)
    {
        $testimonial->fill($request->all());
        $testimonial->save();

        return redirect()->route('admin.testimonial.agency_subscriptions.edit', $testimonial)->withFlashSuccess(__('Відгук оновлено'));
    }
}
