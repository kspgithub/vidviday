<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\TestimonialRequest;
use App\Http\Requests\Tour\TourQuestionRequest;
use App\Models\FaqItem;
use App\Models\IncludeType;
use App\Models\Staff;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Models\TourGroup;
use App\Models\TourQuestion;
use App\Services\TourService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TourController extends Controller
{
    //


    public function index(Request $request, TourGroup $group = null)
    {
        $toursQuery = Tour::search();

        if ($group === null) {
            $tours = Tour::search()->filter($request->all())->paginate($request->input('per_page', 12));
            $request_title = TourService::searchRequestTitle($request->all());
            return view('tour.index', ['tours' => $tours, 'request_title' => $request_title]);
        }

        $toursQuery->whereHas('groups', function ($q) use ($group) {
            return $q->where('id', $group->id);
        });

        $min_price = (clone $toursQuery)->min('price');
        $max_price = (clone $toursQuery)->max('price');

        $tours = $toursQuery->paginate(12);

        return view('tour.group', [
            'tours' => $tours,
            'group' => $group,
            'min_price' => $min_price,
            'max_price' => $max_price,
        ]);
    }


    public function show(string $slug)
    {
        /**
         * @var Tour $tour
         */
        $tour = Tour::findBySlugOrFail($slug);

        $tour->loadMissing([
            'directions',
            'subjects',
            'types',
            'media',
            'places',
            'places.media',
            'tourIncludes',
            'planItems',
            'foodItems',
            'foodItems.time',
            'accommodations',
            'accommodations.media',
            'tickets',
            'discounts',
            'guides',
            'manager',
            'testimonials' => function ($q) {
                return $q->withDepth();
            },
            'questions' => function ($q) {
                return $q->withDepth();
            },
        ]);

        $future_events = $tour->scheduleItems()
            ->whereDate('start_date', '>=', Carbon::now())->orderBy('start_date')->get();

        $nearest_event = $future_events->first();

        $similar_tours = $tour->getSimilarTours(12);


        $faq_items = FaqItem::query()->where('section', FaqItem::SECTION_TOUR)->get();

        return view('tour.show', [
            'tour' => $tour,
            'future_events' => $future_events,
            'nearest_event' => $nearest_event,
            'similar_tours' => $similar_tours,
            'faq_items' => $faq_items,
        ]);
    }


    public function order(Request $request, string $slug)
    {
        $tour = Tour::findBySlugOrFail($slug);
        return view('tour.order', ['tour' => $tour]);
    }


    public function question(TourQuestionRequest $request, Tour $tour)
    {
        $question = new TourQuestion();
        $question->fill($request->validated());
        $question->name = $request->last_name . ' ' . $request->first_name;
        $question->tour_id = $tour->id;
        $user = current_user();
        if ($user) {
            $question->user_id = $user->id;
            if (!empty($user->avatar)) {
                $question->avatar = $user->avatar;
            }
        }
        $question->save();

        if ($request->ajax()) {
            return response()->json([
                'result' => 'success',
                'message' => __('Thank you for your question!'),
                'question' => $question
            ]);
        }

        return redirect()->route('tour.show', $tour->slug)->withFlashSuccess(__('Thank you for your question!'));
    }


    public function testimonial(TestimonialRequest $request, Tour $tour)
    {
        $testimonial = new Testimonial();
        $testimonial->model_type = Tour::class;
        $testimonial->model_id = $tour->id;
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

        return redirect()->route('tour.show', $tour->slug)->withFlashSuccess(__('Thanks for your feedback!'));
    }
}
