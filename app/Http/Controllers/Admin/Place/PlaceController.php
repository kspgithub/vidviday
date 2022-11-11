<?php

namespace App\Http\Controllers\Admin\Place;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Direction;
use App\Models\District;
use App\Models\Place;
use App\Models\Region;
use App\Rules\TranslatableSlugRule;
use App\Rules\UniqueSlugRule;
use App\Services\PlaceService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Throwable;

class PlaceController extends Controller
{
    protected $service;

    public function __construct(PlaceService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View|JsonResponse
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $query = Place::query()->with(['region', 'district', 'city']);

            $q = $request->input('q', '');
            if (! empty($q)) {
                $query->jsonLike('title', "%$q%");
            }

            $region_id = $request->input('region_id', 0);
            if ($region_id > 0) {
                $query->where('region_id', $region_id);
            }

            $district_id = $request->input('district_id', 0);
            if ($district_id > 0) {
                $query->where('district_id', $district_id);
            }

            $perPage = $request->input('per_page', 20);
            if ($perPage === 'all') {
                $perPage = 1000;
            }

            $order = explode(':', $request->input('order', 'bitrix_id:asc'));
            $query->orderBy($order[0] ?? 'title->uk', $order[1] ?? 'asc');

            $paginator = $query->paginate($perPage);

            return response()->json($paginator);
        }

        $regions = Region::toSelectBox();

        return view('admin.place.index', ['regions' => $regions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $place = new Place();
//        $place->country_id = Country::DEFAULT_COUNTRY_ID;
        $directions = Direction::toSelectBox();
        $countries = Country::toSelectBox();
        $regions = Region::query()->where('country_id', Country::DEFAULT_COUNTRY_ID)->toSelectBox();
        $districts = District::query()->where('country_id', Country::DEFAULT_COUNTRY_ID)->toSelectBox();

        return view('admin.place.create', compact('place', 'directions', 'countries', 'regions', 'districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response|RedirectResponse
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'title' => ['required', 'array'],
            'title.uk' => ['required'],
            'slug' => ['required', 'array', new TranslatableSlugRule()],
            'slug.uk' => ['required', new UniqueSlugRule('places', 'slug')],
            'slug.ru' => [new UniqueSlugRule('places', 'slug')],
            'slug.en' => [new UniqueSlugRule('places', 'slug')],
            'slug.pl' => [new UniqueSlugRule('places', 'slug')],
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($params);
        }
        $place = $this->service->store($params);

        return redirect()->route('admin.place.edit', $place)->withFlashSuccess(__('Record Created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Place  $place
     * @return View
     */
    public function edit(Place $place)
    {
        //
        $directions = Direction::toSelectBox();
        $countries = Country::toSelectBox();
        $regions = Region::query()->where('country_id', Country::DEFAULT_COUNTRY_ID)->toSelectBox();
        $districts = District::query()->where('country_id', Country::DEFAULT_COUNTRY_ID)->toSelectBox();

        return view('admin.place.edit', compact('place', 'directions', 'countries', 'regions', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Place  $place
     * @return Response|JsonResponse|RedirectResponse
     *
     * @throws GeneralException
     * @throws Throwable
     */
    public function update(Request $request, Place $place)
    {
        //
        $params = $request->all();
        if (! $request->ajax()) {
            $validator = Validator::make($params, [
                'title' => ['required', 'array'],
                'title.uk' => ['required'],
                'slug' => ['required', 'array', new TranslatableSlugRule()],
                'slug.uk' => ['required', new UniqueSlugRule('places', 'slug', $place->id)],
                'slug.ru' => [new UniqueSlugRule('places', 'slug', $place->id)],
                'slug.en' => [new UniqueSlugRule('places', 'slug', $place->id)],
                'slug.pl' => [new UniqueSlugRule('places', 'slug', $place->id)],
                'text' => ['required', 'array'],
                'text.uk' => ['required'],
                'direction_id' => ['nullable'],
                'region_id' => ['nullable'],
                'district_id' => ['nullable'],
                'city_id' => ['nullable'],
                'lat' => ['nullable'],
                'lng' => ['nullable'],
            ]);
            if ($validator->fails()) {
                return redirect()->route('admin.place.edit', $place)
                    ->withErrors($validator);
            }
        }

        $this->service->update($place, $params);

        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'model' => $place, 'message' => __('Record Updated')]);
        }

        return redirect()->route('admin.place.edit', $place)->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @param  Place  $place
     * @return Response|JsonResponse
     */
    public function destroy(Request $request, Place $place)
    {
        $this->service->destroy($place);
        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'model' => $place, 'message' => __('Record Deleted')]);
        }

        return redirect()->route('admin.place.index')->withFlashSuccess(__('Record Deleted'));
    }
}
