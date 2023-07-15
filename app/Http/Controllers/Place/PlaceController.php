<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Controller;
use App\Http\Requests\Place\TestimonialRequest;
use App\Models\Country;
use App\Models\Place;
use App\Models\Region;
use App\Models\City;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Models\Badge;
use App\Models\Page;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use App\Models\VisualOption;
use Storage;

class PlaceController extends Controller
{
    public function index()
    {
        //

//        $countries = Country::query()->with('regions', function(HasMany $q) {
//            $q->whereHas('places', fn ($q) => $q->published())
//                ->with(['places' => fn ($q) => $q->published()->with('media')]);
//        })->get();

        $countries = Country::query()->published()->whereHas('places', fn ($q) => $q->published())->toSelectBox();

        $pageContent = Page::select()->where('key', 'places')->first();

        $markers = Place::query()->published()->get()->map->asMapMarker();

        $giftImage = VisualOption::where('key', 'gift_image')->first();

        return view('place.index', [
            'countries' => $countries,
            'pageContent' => $pageContent,
            'markers' => $markers,
            'giftImage' => $giftImage->value ? Storage::url($giftImage->value) : '/img/gift-certificate.jpg',
        ]);
    }

    public function show($slug)
    {
        $place = Place::findBySlugOrFail($slug, false);

        if(!$place->published) {
            abort(404);
        }

        $place->checkSlugLocale($slug);
        $localeLinks = $place->getLocaleLinks();

        $place->loadMissing([
            'media',
            'testimonials' => function ($q) {
                return $q->moderated();
            },
        ])
            ->loadCount([
                'testimonials' => function ($q) {
                    return $q->moderated()
                    ->orderBy('rating', 'desc')
                    ->latest();
                },
            ])
            ->loadAvg('testimonials', 'rating');

        $tours = $place->tours()->published()
            ->withCount(['testimonials' => function ($q) {
                return $q->moderated()
                    ->orderBy('rating', 'desc')
                    ->latest();
            }])->paginate(6);
        $price_from = $place->tours()->published()->min('price');
        $price_to = $place->tours()->published()->max('price');

        $giftImage = VisualOption::where('key', 'gift_image')->first();

        return view('place.show', [
            'localeLinks' => $localeLinks,
            'place' => $place,
            'tours' => $tours,
            'price_from' => $price_from,
            'price_to' => $price_to,
            'giftImage' => $giftImage->value ? Storage::url($giftImage->value) : '/img/gift-certificate.jpg',
        ]);
    }


    public function testimonial(TestimonialRequest $request, Place $place)
    {
        $this->validate($request, [
            'avatar_upload' => ['nullable', 'file', 'max:500']
        ]);
        $testimonial = new Testimonial();
        $testimonial->model_type = Place::class;
        $testimonial->model_id = $place->id;
        $testimonial->fill($request->validated());
        $testimonial->name = $request->last_name . ' ' . $request->first_name;
        $user = current_user();

        if ((int) $request->tour_id > 0) {
            $testimonial->related_type = Tour::class;
            $testimonial->related_id = (int) $request->tour_id;
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
                'question' => $testimonial,
            ]);
        }

        return redirect()->to($place->url)->withFlashSuccess(__('Thanks for your feedback!'));
    }


    public function testimonials(Request $request, Place $place)
    {
        $testimonials = Testimonial::query()
            ->moderated()
            ->whereNull('parent_id')
            ->with([
                'user',
                'parent',
                'media',
                'parent.user',
                'model',
                'related',
            ])
            ->withCount('children')
            ->orderBy('rating', 'desc')
            ->latest();

        return $testimonials->paginate(10);
    }

}
