<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Place\TestimonialRequest;
use App\Models\Staff;
use App\Models\StaffType;
use App\Models\Page;
use App\Models\Testimonial;
use App\Models\Tour;


class StaffController extends Controller
{

    public function index()
    {
        //
        $specialists = Staff::published()->whereHas('types', function ($q) {
            return $q->where('slug', 'official');
        })->withCount(['testimonials', 'tours'])->get();
        $pageContent = Page::select()->where('key', 'office-workers')->first();

        return view('staff.index', [
            'specialists' => $specialists,
            'pageContent' => $pageContent
        ]);
    }

    public function show(Staff $staff)
    {
        $staff->loadMissing([
            'testimonials' => function ($q) {
                return $q->moderated();
            },
        ]);
        $tours = $staff->tours()->with('scheduleItems', function ($q) {
            return $q->inFuture();
        })->get();
        return view('staff.worker', ['staff' => $staff, 'tours' => $tours]);
    }


    public function testimonial(TestimonialRequest $request, Staff $staff)
    {
        $testimonial = new Testimonial();
        $testimonial->model_type = Staff::class;
        $testimonial->model_id = $staff->id;
        $testimonial->fill($request->validated());
        $testimonial->name = $request->last_name . ' ' . $request->first_name;
        $user = current_user();

        if ((int)$request->tour_id > 0) {
            $testimonial->related_type = Tour::class;
            $testimonial->related_id = (int)$request->tour_id;
        }

        if ($user) {
            $testimonial->user_id = $user->id;
            if (!empty($user->avatar)) {
                $testimonial->avatar = $user->avatar;
            }
        }
        if (site_option('moderate_testimonials', true) === false) {
            $testimonial->status = Testimonial::STATUS_PUBLISHED;
        }
        $testimonial->save();
        if ($request->hasFile('avatar_upload')) {
            $testimonial->uploadAvatar($request->file('avatar_upload'));
        }

        if ($request->hasFile('images_upload')) {
            foreach ($request->file('images_upload') as $file) {
                $testimonial->storeMedia($file);
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'result' => 'success',
                'message' => __('Thanks for your feedback!'),
                'question' => $testimonial
            ]);
        }

        return redirect()->back()->withFlashSuccess(__('Thanks for your feedback!'));
    }

}
