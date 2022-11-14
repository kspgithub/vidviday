<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\Finance;
use App\Models\IncludeType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        //
        $type_id = $request->input('type_id', 1);

        $items = Finance::query()->where('type_id', $type_id)->with(['type'])->withCount(['media'])
            ->orderBy('type_id')->paginate(20);

        return view('admin.finance.index', [
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(Request $request)
    {
        //
        $finance = new Finance();
        $finance->type_id = (int) $request->input('type_id', 1);
        $types = IncludeType::toSelectBox();

        return view('admin.finance.create', [
            'model' => $finance,
            'types' => $types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request  $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $finance = new Finance();
        $finance->fill($request->all());
        $finance->save();
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $imageFile) {
                $finance->storeMedia($imageFile);
            }
        }

        return redirect()->route('admin.finance.edit', $finance)->withFlashSuccess(__('Record Created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Finance  $finance
     *
     * @return View
     */
    public function edit(Finance $finance)
    {
        //
        $types = IncludeType::toSelectBox();

        return view('admin.finance.edit', [
            'model' => $finance,
            'types' => $types,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request  $request
     * @param Finance  $finance
     *
     * @return Response|JsonResponse
     */
    public function update(Request $request, Finance $finance)
    {
        //
        $finance->fill($request->all());
        $finance->save();
        if ($request->ajax()) {
            return response()->json(['result' => 'OK']);
        }

        return redirect()->route('admin.finance.index')->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Finance  $finance
     *
     * @return Response
     */
    public function destroy(Finance $finance)
    {
        //
        $finance->delete();

        return redirect()->route('admin.finance.index')->withFlashSuccess(__('Record Deleted'));
    }
}
