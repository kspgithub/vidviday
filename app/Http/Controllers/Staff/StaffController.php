<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Place\TestimonialRequest;
use App\Models\PopupAd;
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

        $popupAds = PopupAd::query()->whereJsonContains('pages', $pageContent->key)->get();

        return view('staff.index', [
            'specialists' => $specialists,
            'pageContent' => $pageContent,
            'popupAds' => $popupAds,
        ]);
    }

    public function show($slug)
    {
        $staff = Staff::findBySlugOrFail($slug);
        $staff->loadMissing([
            'testimonials' => function ($q) {
                return $q->moderated();
            },
            'tours' => function ($q) {
                return $q->with('scheduleItems', function ($q) {
                    return $q->inFuture();
                })->withAvg('testimonials', 'rating')
                    ->withCount(['testimonials' => function ($q) {
                        return $q->moderated()
                            ->orderBy('rating', 'desc')
                            ->latest();
                    }]);
            },
            'manageTours' => function ($q) {
                return $q->with('scheduleItems', function ($q) {
                    return $q->inFuture();
                })->withAvg('testimonials', 'rating')
                    ->withCount(['testimonials' => function ($q) {
                        return $q->moderated()
                            ->orderBy('rating', 'desc')
                            ->latest();
                    }]);
            },
        ]);

        $tours = $staff->tours->merge($staff->manageTours);

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
