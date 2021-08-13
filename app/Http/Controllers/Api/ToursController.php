<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\SearchToursRequest;
use App\Models\Tour;
use Illuminate\Http\Request;

class ToursController extends Controller
{
    //

    public function index(SearchToursRequest $request)
    {
        return Tour::search()->filter($request->validated())->paginate($request->input('per_page', 12));
    }
}
