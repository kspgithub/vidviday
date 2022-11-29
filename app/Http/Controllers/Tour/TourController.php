<?php

namespace App\Http\Controllers\Tour;

use App\Exports\ScheduleExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\TestimonialRequest;
use App\Http\Requests\Tour\TourQuestionRequest;
use App\Http\Requests\TourOrderRequest;
use App\Http\Requests\TourVotingRequest;
use App\Lib\Bitrix24\CRM\Deal\DealOrder;
use App\Mail\TourOrderAdminEmail;
use App\Mail\TourOrderEmail;
use App\Models\AccommodationType;
use App\Models\FaqItem;
use App\Models\IncludeType;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\PopupAd;
use App\Models\Staff;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Models\TourDiscount;
use App\Models\TourGroup;
use App\Models\TourQuestion;
use App\Models\TourSchedule;
use App\Models\TourVoting;
use App\Models\WrongQuery;
use App\Services\MailNotificationService;
use App\Services\OrderService;
use App\Services\TourService;
use Exception;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;


class TourController extends Controller
{
    /**
     * @param Request $request
     * @param TourGroup|null|mixed $group
     * @return View
     */
    public function index(Request $request, TourGroup $group)
    {
        if (!$group->exists) {
            $query = Tour::search(false)->filter($request->all());
            $tours = $query->paginate($request->input('per_page', 12));
            $request_title = TourService::searchRequestTitle($request->all());

            if(!$tours->count() && ($q = $request->get('q'))) {
                TourService::handleWrongRequest($request);
            }

            return view('tour.index', ['tours' => $tours, 'request_title' => $request_title]);
        }

        $localeLinks = $group->getLocaleLinks();

        $toursQuery = $group->tours()->search(false);

        $min_price = (clone $toursQuery)->min('price');
        $max_price = (clone $toursQuery)->max('price');

        $tours = $toursQuery->paginate(120);

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

        $popupAds = PopupAd::query()
            ->join('popup_ad_rules', 'popup_ads.id', '=', 'popup_ad_rules.popup_ad_id')
            ->where('popup_ad_rules.model_type', Tour::class)
            ->where(function ($q) use ($tour){
                $q->where('popup_ad_rules.model_id', $tour->id)->orWhere('popup_ad_rules.model_id', 0);
            })
            ->orderBy('popup_ad_rules.model_id', 'desc')
            ->limit(1)
            ->get();

        view()->share('popupAds', $popupAds);

        $tour->loadMissing([
            'directions',
            'subjects',
            'types',
            'media',
            'places',
            'places.media',
            'tourPlaces',
            'tourPlaces.media',
            'tourPlaces.place',
            'tourPlaces.place.media',
            'tourIncludes',
            'tourIncludes.finance',
            'planItems',
            'foodItems',
            'foodItems.time',
            'foodItems.food',
            'foodItems.food.media',
            'foodItems.food.time',
            'tourAccommodations',
            'tourAccommodations.media',
            'tourAccommodations.accommodation',
            'tourAccommodations.accommodation.media',
            'tickets',
            'tourTickets',
            'tourTickets.ticket',
            'discounts',
            'tourDiscounts',
            'tourDiscounts.discount',
            'guides',
            'manager',
            'manager.types',
            'landings',
            'questions' => function ($q) {
                return $q->moderated();
            },
//            'votings' => function ($q) {
//                $ip = request()->ip();
//                $user = request()->user();
//
//                $q->where('ip', $ip);
//
//                if($user && $user->id) {
//                    $q->orWhere('user_id', $user->id);
//                }
//                if($user && $user->email) {
//                    $q->orWhere('email', $user->email);
//                }
//                if($user && $user->phone) {
//                    $q->orWhere('phone', $user->phone);
//                }
//
//                return $q;
//            },
        ]);

        $tour->loadCount([
            'testimonials' => fn ($q) => $q->moderated()
                    ->orderBy('rating', 'desc')
                    ->latest(),

            'votings' => fn ($q) => $q->published(),
        ]);

        $tour->loadAvg(['testimonials' => function ($q) {
            return $q->moderated()
                ->orderBy('rating', 'desc')
                ->latest();
        }], 'rating');

        $future_events = $tour->schedulesForBooking();

        $nearest_event = $future_events->first();

        $similar_tours = $tour->getSimilarTours(12);

        $faq_items = FaqItem::whereSection(FaqItem::SECTION_TOURIST)->orderBy('sort_order')->get();

        $price_items = $tour->calcItems();

        $user = current_user();
        if ($user !== null) {
            $user->viewTour($tour->id);
        }

        $pictures = $tour->getMedia('main');
        $tourPictures = $tour->getMedia('pictures', ['published' => true]);

        if($tourPictures->count()) {
            $pictures = $pictures->merge($tourPictures);
        }

        $testimonials = $tour->testimonials()
            ->where('rating', '>=', 4)
            ->where('parent_id', null)
            ->limit(2)
            ->get();

        $viewData = [
            'tour' => $tour,
            'future_events' => $future_events,
            'nearest_event' => $nearest_event,
            'similar_tours' => $similar_tours,
            'faq_items' => $faq_items,
            'price_items' => $price_items,
            'localeLinks' => $localeLinks,
            'pictures' => $pictures,
            'testimonials' => $testimonials,
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


    public function testimonials(Request $request, Tour $tour)
    {
        $testimonials = $tour->testimonials()
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

    public function testimonialChildren(Request $request, Tour $tour, Testimonial $testimonial)
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

        $discounts = TourService::getAvailableDiscounts($tour);

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
        $order = OrderService::createOrder($params);


        if ($order === false) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => 'Помилка при замовлені туру']);
            }
            return back()->withFlashError('Помилка при замовлені туру');
        } else {
            $order->syncContact();
            MailNotificationService::adminTourOrder($order);
            MailNotificationService::userTourOrder($order);

            if ((int)$order->payment_type === PaymentType::TYPE_ONLINE) {
                $redirect_route = 'order.purchase';
            } else {
                $redirect_route = 'order.success';
            }
            if ($request->ajax()) {
                return response()->json(['result' => 'success', 'redirect_url' => route($redirect_route, $order)]);
            }
            return redirect()->route($redirect_route, $order);
        }
    }

    public function voting(TourVotingRequest $request, Tour $tour)
    {
        $params = $request->validated();
        $params['tour_id'] = $tour->id;
        $params['ip'] = $request->ip();
        $params['user_id'] = $request->user() ? $request->user()->id : null;

        $existing = $tour->votings()->where(function (Builder $q) use ($params) {
            $q
//                ->where('ip', $params['ip'])
                ->orWhere('email', $params['email'])
                ->orWhere('phone', $params['phone']);

            if ($params['user_id']) {
//                $q->orWhere('user_id', $params['user_id']);
            }

            return $q;
        });

        if (!$existing->count()) {
            $tour->votings()->create($params);

            return response()->json(['result' => 'success']);
        } else {

            return response()->json(['result' => 'error', 'message' => __('tours-section.already-voted')]);
        }
    }

    public function votingSuccess(Tour $tour, TourVoting $voting)
    {

        return view('tour.success', ['tour' => $tour, 'voting' => $voting]);
    }

    public function download()
    {
        return Excel::download(new ScheduleExport(), 'tours.xlsx');

    }
}
