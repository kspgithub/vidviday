<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Controller;
use App\Http\Requests\Place\TestimonialRequest;
use App\Models\Place;
use App\Models\Region;
use App\Models\City;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Models\Badge;
use App\Models\Page;

class PlaceController extends Controller
{

    public function index()
    {
        //

        $regions = Region::whereHas('places', fn($q) => $q->published())
            ->with(['places' => fn($q) => $q->published()])->get();

        $pageContent = Page::select()->where('key', 'places')->first();

        $markers = Place::query()->published()->get()->map->asMapMarker();

        return view('place.index', [
            'regions' => $regions,
            'pageContent' => $pageContent,
            'markers' => $markers,
        ]);
    }

    public function show($slug)
    {

        $place = Place::query()->where('slug', 'LIKE', '%"' . $slug . '"%')->firstOrFail();
        $tours = $place->tours()->published()->paginate(6);
        $price_from = $place->tours()->published()->min('price');
        $price_to = $place->tours()->published()->max('price');
        return view('place.show', [
            'place' => $place,
            'tours' => $tours,
            'price_from' => $price_from,
            'price_to' => $price_to,
        ]);
    }


    public function testimonial(TestimonialRequest $request, Place $place)
    {
        $testimonial = new Testimonial();
        $testimonial->model_type = Place::class;
        $testimonial->model_id = $place->id;
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

        return redirect()->route('place.show', $place->slug)->withFlashSuccess(__('Thanks for your feedback!'));
    }
}
