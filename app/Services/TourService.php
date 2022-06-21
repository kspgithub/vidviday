<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\Direction;
use App\Models\Discount;
use App\Models\LandingPlace;
use App\Models\Place;
use App\Models\Tour;
use App\Models\TourDiscount;
use App\Models\TourSchedule;
use App\Models\TourSubject;
use App\Models\TourType;
use Cache;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Image\Manipulations;

class TourService extends BaseService
{


    /**
     * TourService constructor.
     *
     * @param Tour $tour
     */
    public function __construct(Tour $tour)
    {
        $this->model = $tour;
    }


    public static function filterOptions()
    {
        $locale = app()->getLocale();


        return Cache::remember('filter-options-' . $locale, 1, function () {
            $places = Place::published()->whereHas('tours', function ($sq) {
                return $sq->where('published', 1)->whereHas('scheduleItems', function ($ssq) {
                    return $ssq->where('published', 1)->whereDate('start_date', '>', Carbon::today());
                });
            })->orderBy('title->uk')->toSelectBox()->toArray();

            $landings = LandingPlace::published()->whereHas('tours', function ($sq) {
                return $sq->where('published', 1)->whereHas('scheduleItems', function ($ssq) {
                    return $ssq->where('published', 1)->whereDate('start_date', '>', Carbon::today());
                });
            })->orderBy('title->uk')->toSelectBox()->toArray();

            $subjects = TourSubject::published()->toSelectBox()->toArray();
            $types = TourType::published()->toSelectBox()->toArray();
            $directions = Direction::published()->toSelectBox()->toArray();


            return [
                'date_from' => Carbon::now()->format('d.m.Y'),
                'date_to' => Carbon::now()->addYears(1)->format('d.m.Y'),
                'duration_from' => 0,
                'duration_to' => (int)Tour::query()->max('duration') ?? 14,
                'price_from' => 0,
                'price_to' => (int)Tour::query()->max('price') ?? 10000,
                'directions' => [['value' => 0, 'text' => __('tours-section.direction')]] + $directions,
                'types' => [['value' => 0, 'text' => __('tours-section.type')]] + $types,
                'subjects' => [['value' => 0, 'text' => __('tours-section.subject')]] + $subjects,
                'places' => [['value' => 0, 'text' => __('tours-section.places')]] + $places,
                'landings' => [['value' => 0, 'text' => __('tours-section.landing-places')]] + $landings,
                'sorting' => [
                    ['value' => 'price-asc', 'text' => __('tours-section.sorting.price-asc')],
                    ['value' => 'price-desc', 'text' => __('tours-section.sorting.price-desc')],
                    ['value' => 'created-desc', 'text' => __('tours-section.sorting.created-desc')],
                    ['value' => 'created-asc', 'text' => __('tours-section.sorting.created-asc')],
                ],
                'pagination' => [
                    ['value' => 12, 'text' => '12'],
                    ['value' => 24, 'text' => '24'],
                    ['value' => 48, 'text' => '48'],
                    ['value' => 1000, 'text' => __('tours-section.all-tours')],
                ],
            ];
        });
    }

    public static function searchRequestTitle($params)
    {
        $title = [];

        if (!empty($params['q'])) {
            $title[] = urldecode($params['q']);
        }
        if (!empty($params['direction'])) {
            $direction = Direction::where('id', $params['direction'])->select('title')->first();
            $title[] = $direction->title;
        }
        if (!empty($params['type'])) {
            $direction = TourType::where('id', $params['type'])->select('title')->first();
            $title[] = $direction->title;
        }
        if (!empty($params['subject'])) {
            $direction = TourSubject::where('id', $params['subject'])->select('title')->first();
            $title[] = $direction->title;
        }
        return implode(', ', $title);
    }

    public static function popularTours($count = 12, $locale = 'uk')
    {
        return Tour::search()
            ->whereJsonContains('locales', $locale)
            ->whereHas('badges', function (Builder $q) {
                return $q->where('slug', 'bestseller');
            })->take($count)->get();
    }

    public function store($params)
    {
        $tour = new Tour();
        $tour->published = 0;

        return $this->update($tour, $params);
    }

    public function update(Tour $tour, array $params = [])
    {
        DB::beginTransaction();

        try {
            $tour->fill($params);
            $tour->save();

            if (array_key_exists('main_image', $params) && empty($params['main_image'])) {
                $tour->clearMediaCollection('main');
            }
            if (array_key_exists('mobile_image', $params) && empty($params['mobile_image'])) {
                $tour->clearMediaCollection('mobile');
            }
            if (isset($params['main_image_upload'])) {
                $tour->storeMedia($params['main_image_upload'], 'main');
            }
            if (isset($params['mobile_image_upload'])) {
                $tour->storeMedia($params['mobile_image_upload'], 'mobile', [
                    'width' => 320,
                    'height' => 320,
                    'fit' => Manipulations::FIT_CROP,
                ]);
            }

            if (array_key_exists('staff', $params)) {
                $staff = array_filter($params['staff']);
                $tour->staff()->sync($staff);
            }

            if (array_key_exists('badges', $params)) {
                $badges = array_filter($params['badges']);
                $tour->badges()->sync($badges);
            }
            if (array_key_exists('groups', $params)) {
                $groups = array_filter($params['groups']);
                $tour->groups()->sync($groups);
            }

            if (array_key_exists('types', $params)) {
                $types = array_filter($params['types']);
                $tour->types()->sync($types);
            }

            if (array_key_exists('subjects', $params)) {
                $types = array_filter($params['subjects']);
                $tour->subjects()->sync($types);
            }

            if (array_key_exists('directions', $params)) {
                $directions = array_filter($params['directions']);
                $tour->directions()->sync($directions);
            }

            if (array_key_exists('plan', $params)) {
                $plan = array_filter($params['plan']);
                $tour->planItems()->updateOrCreate(['tour_id' => $tour->id], $plan);
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());
            throw new GeneralException(__('There was a problem updating tour.'));
        }
        DB::commit();

        return $tour;
    }

    public static function getAvailableDiscounts(Tour $tour)
    {
        $tourDiscounts = $tour->tourDiscounts()->available()->where('age_limit', 0)->whereNotIn('category', ['children_young', 'children', 'children_older']);

        $discounts = $tour->discounts()->available()->where('discounts.age_limit', 0)->whereNotIn('discounts.category', ['children_young', 'children', 'children_older']);

        return $discounts->get($discounts->get()->merge($tourDiscounts->get()));
    }

    public static function getFilteredAvailableDiscounts(Tour $tour, array $filters = [
        'categories' => [
            'in' => [],
            'notIn' => [],
        ],
        'age_limit' => false,
    ])
    {
        $tourDiscounts = $tour->tourDiscounts()->custom();
        $discounts = $tour->discounts();

        if($filters['categories']['in'] ?? false) {
            $tourDiscounts->whereIn('category', $filters['categories']['in']);
            $discounts->whereIn('discounts.category', $filters['categories']['in']);
        }
        if($filters['categories']['notIn'] ?? false) {
            $tourDiscounts->whereNotIn('category', $filters['categories']['notIn']);
            $discounts->whereNotIn('discounts.category', $filters['categories']['notIn']);
        }

        if($filters['age_limit'] ?? false) {
            $tourDiscounts->where('age_limit', $filters['categories']['age_limit']);
            $discounts->where('discounts.age_limit', $filters['categories']['age_limit']);
        }

        return $discounts->get()->merge($tourDiscounts->get());
    }
}
