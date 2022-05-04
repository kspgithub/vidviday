<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\TestimonialRequest;
use App\Http\Requests\Tour\TourQuestionRequest;
use App\Http\Requests\TourOrderRequest;
use App\Lib\Bitrix24\CRM\Deal\DealOrder;
use App\Mail\TourOrderAdminEmail;
use App\Mail\TourOrderEmail;
use App\Models\AccommodationType;
use App\Models\FaqItem;
use App\Models\IncludeType;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\Staff;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Models\TourGroup;
use App\Models\TourQuestion;
use App\Models\TourSchedule;
use App\Services\MailNotificationService;
use App\Services\OrderService;
use App\Services\TourService;
use Exception;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class TourController extends Controller
{
    //

    /**
     * @param Request $request
     * @param TourGroup|null|mixed $group
     * @return View
     */
    public function index(Request $request, TourGroup $group = null)
    {
        $localeLinks = $group->getLocaleLinks();

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
            'localeLinks' => $localeLinks,
        ]);
    }


    public function show(string $slug)
    {

        /**
         * @var Tour $tour
         */
        $tour = Tour::findBySlugOrFail($slug, false);
        $tour->checkSlugLocale($slug);
        $localeLinks = $tour->getLocaleLinks();

        $tour->loadMissing([
            'directions',
            'subjects',
            'types',
            'media',
            'places',
            'places.media',
            'tourIncludes',
            'tourIncludes.finance',
            'planItems',
            'foodItems',
            'foodItems.food',
            'foodItems.food.media',
            'foodItems.time',
            'accommodations',
            'accommodations.media',
            'tickets' => function ($q) {
                return $q->orderBy('position');
            },
            'discounts',
            'guides',
            'manager',
            'landings',
            'testimonials' => function ($q) {
                return $q->moderated();
            },
            'questions' => function ($q) {
                return $q->moderated();
            },
        ]);

        $tour->loadCount([
            'testimonials' => function ($q) {
                return $q->moderated();
            }
        ]);

        $future_events = $tour->schedulesForBooking();

        $nearest_event = $future_events->first();

        $similar_tours = $tour->getSimilarTours(12);


        $faq_items = FaqItem::query()->where('section', FaqItem::SECTION_TOUR)->get();

        $price_items = $tour->calcItems();

        $user = current_user();
        if ($user !== null) {
            $user->viewTour($tour->id);
        }

        $viewData = [
            'tour' => $tour,
            'future_events' => $future_events,
            'nearest_event' => $nearest_event,
            'similar_tours' => $similar_tours,
            'faq_items' => $faq_items,
            'price_items' => $price_items,
            'localeLinks' => $localeLinks,
        ];

//        if ((int)request()->input('print', 0) === 1) {
//            $pdf = PDF::loadView('tour.show', $viewData);
//            return $pdf->download($tour->slug . '.pdf');
//        }

        return view('tour.show', $viewData);
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
        if (site_option('moderate_questions', true) === false) {
            $question->status = TourQuestion::STATUS_PUBLISHED;
        }
        $question->save();

        if ($request->ajax()) {
            return response()->json([
                'result' => 'success',
                'message' => __('Thank you for your question!'),
                'question' => $question
            ]);
        }

        return redirect($tour->url)->withFlashSuccess(__('Thank you for your question!'));
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

        return redirect($tour->url)->withFlashSuccess(__('Thanks for your feedback!'));
    }

    public function order(Request $request, Tour $tour)
    {
        $schedules = $tour->schedulesForBooking();

        $discounts = $tour->discounts()->available()->get();
        $room_types = AccommodationType::all()->translate();
        $payment_types = PaymentType::published()->toSelectBox();

        return view('tour.order', [
            'tour' => $tour,
            'schedules' => $schedules,
            'discounts' => $discounts,
            'room_types' => $room_types,
            'payment_types' => $payment_types,
            'confirmation_types' => Order::confirmationSelectBox(),
        ]);
    }

    public function orderConfirm(TourOrderRequest $request, Tour $tour)
    {
        $params = $request->validated();
        $params['tour_id'] = $tour->id;
        $params['user_id'] = current_user() ? current_user()->id : null;
        $params['is_tour_agent'] = current_user() && current_user()->isTourAgent() ? 1 : 0;
        if ($params['is_tour_agent'] === 1) {
            $params['agency_data'] = [
                'title' => current_user()->company,
            ];
        }
        $order = OrderService::createOrder($params);
        if ($order !== false && config('services.bitrix24.integration')) {
            try {
                DealOrder::createCrmDeal($order);
            } catch (Exception $e) {
                Log::error($e->getMessage());
            }
        }

        if ($order === false) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => 'Помилка при замовлені туру']);
            }
            return back()->withFlashError('Помилка при замовлені туру');
        } else {
            $order->syncContact();
            MailNotificationService::adminTourOrder($order);
            MailNotificationService::userTourOrder($order);

            if ($request->ajax()) {
                return response()->json(['result' => 'success', 'redirect_url' => route('order.success', $order)]);
            }
            return redirect()->route('order.success', $order);
        }
    }
}
