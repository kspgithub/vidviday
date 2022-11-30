<?php

namespace App\Http\Controllers\Testimonial;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialAnswerRequest;
use App\Http\Requests\Tour\TestimonialRequest;
use App\Models\Page;
use App\Models\PopupAd;
use App\Models\Staff;
use App\Models\Testimonial;
use App\Models\Tour;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    //


    public function index(Request $request)
    {
        $testimonials = Testimonial::moderated()->whereNull('parent_id')
            ->with([
                'user',
                'parent',
                'media',
                'parent.user',
                'model',
                'related',
            ])
            ->withCount('children')
            ->orderBy('created_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return response()->json($testimonials);
        }
        $pageContent = Page::query()->where('key', 'testimonials')->first();

        $popupAds = PopupAd::query()->forModel($pageContent)->get();

        return view('contact.testimonials', [
            'pageContent' => $pageContent,
            'testimonials' => $testimonials,
            'popupAds' => $popupAds,
        ]);
    }


    public function store(TestimonialRequest $request)
    {
        $testimonial = new Testimonial();
        $testimonial->model_type = Tour::class;
        $testimonial->model_id = $request->tour_id;
        $testimonial->fill($request->validated());
        $testimonial->name = $request->last_name . ' ' . $request->first_name;
        $user = current_user();

        if ((int)$request->guide_id > 0) {
            $testimonial->related_type = Staff::class;
            $testimonial->related_id = (int)$request->guide_id;
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
                'testimonial' => $testimonial
            ]);
        }

        return back()->withFlashSuccess(__('Thanks for your feedback!'));
    }

    public function answer(TestimonialAnswerRequest $request)
    {
        $parent = Testimonial::findOrFail($request->parent_id);
        $user = current_user();

        $testimonial = new Testimonial();
        $testimonial->model_type = $parent->model_type;
        $testimonial->model_id = $parent->model_id;
        $testimonial->related_type = $parent->related_type;
        $testimonial->related_id = $parent->related_id;
        $testimonial->name = $user->name;
        $testimonial->email = $user->email;
        $testimonial->avatar = $user->avatar;
        $testimonial->parent_id = $parent->id;
        $testimonial->text = $request->text;
        if (site_option('moderate_testimonials', true) === false) {
            $testimonial->status = Testimonial::STATUS_PUBLISHED;
        }
        $testimonial->save();
        if ($request->ajax()) {
            return response()->json([
                'result' => 'success',
                'message' => __('Thanks for your feedback!'),
                'testimonial' => $testimonial
            ]);
        }
        return back()->withFlashSuccess(__('Thanks for your feedback!'));
    }


    public function children(Testimonial $testimonial)
    {
        $children = $testimonial->children()
            ->with([
                'user',
                'parent',
                'media',
                'parent.user',
                'model',
                'related',
            ])
            ->withCount('children')
            ->orderBy('created_at', 'desc')->get();

        return response()->json($children);
    }
}
