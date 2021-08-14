<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\SearchToursRequest;
use App\Models\Tour;
use App\Services\TourService;
use Illuminate\Http\Request;

class ToursController extends Controller
{
    //

    public function index(SearchToursRequest $request)
    {
        $result = Tour::search()->filter($request->validated())->paginate($request->input('per_page', 12))->toArray();
        $result['request_title'] = TourService::searchRequestTitle($request->validated());
        return response()->json($result);
    }


    public function popular(Request $request)
    {
        return TourService::popularTours($request->input('count', 12));
    }
}
