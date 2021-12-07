<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Finance;
use App\Models\IncludeType;
use App\Models\Tour;
use App\Models\TourInclude;
use Illuminate\Http\Request;

class TourFinanceController extends Controller
{
    //

    public function index(Tour $tour)
    {
        return view('admin.tour.finance.index', ['tour' => $tour]);
    }

    public function create(Tour $tour)
    {
        $model = new TourInclude();
        $model->type_id = 0;
        $model->finance_id = 0;
        $types = IncludeType::query()->whereIn('id', [1, 2])->toSelectBox();
        $includeOptions = Finance::query()->where('type_id', 1)->toSelectBox();
        $excludeOptions = Finance::query()->where('type_id', 2)->toSelectBox();
        $finances = Finance::query()->get();
        return view('admin.tour.finance.create', [
            'model' => $model,
            'tour' => $tour,
            'types' => $types,
            'finances' => $finances,
            'includeOptions' => $includeOptions,
            'excludeOptions' => $excludeOptions,
        ]);
    }

    public function store(Request $request, Tour $tour)
    {
        $model = new TourInclude();
        $model->fill($request->all());
        $model->tour_id = $tour->id;
        if ((int)$model->finance_id === 0) {
            $model->finance_id = null;
        }
        $model->save();

        return redirect()->route('admin.tour.finance.index', $tour)->withFlashSuccess(__('Record Created'));
    }

    public function edit(Tour $tour, TourInclude $model)
    {
        $types = IncludeType::query()->whereIn('id', [1, 2])->toSelectBox();
        $includeOptions = Finance::query()->where('type_id', 1)->toSelectBox();
        $excludeOptions = Finance::query()->where('type_id', 2)->toSelectBox();
        $finances = Finance::query()->get();
        return view('admin.tour.finance.edit', [
            'model' => $model,
            'tour' => $tour,
            'types' => $types,
            'finances' => $finances,
            'includeOptions' => $includeOptions,
            'excludeOptions' => $excludeOptions,
        ]);
    }

    public function update(Request $request, Tour $tour, TourInclude $model)
    {
        $model->fill($request->all());
        $model->tour_id = $tour->id;
        if ((int)$model->finance_id === 0) {
            $model->finance_id = null;
        }
        $model->save();
        return redirect()->route('admin.tour.finance.index', $tour)->withFlashSuccess(__('Record Updated'));
    }
}
