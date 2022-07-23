<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Exports\VotingsExport;
use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TourVotingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View|BinaryFileResponse
     */
    public function index(Request $request, Tour $tour)
    {
        //
        if ($request->input('export', 0) == 1) {
            return Excel::download(new VotingsExport($tour->votings), 'export.xlsx');
        }

        return view('admin.tour.voting.index', [
            'tour' => $tour,
        ]);
    }
}
