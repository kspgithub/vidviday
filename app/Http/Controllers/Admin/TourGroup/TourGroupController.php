<?php

namespace App\Http\Controllers\Admin\TourGroup;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourGroup;
use App\Rules\TranslatableSlugRule;
use App\Rules\UniqueSlugRule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TourGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        $tourGroups = TourGroup::query()->withCount(['media', 'tours'])->paginate(20);

        return view('admin.tour-group.index', compact('tourGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $tourGroup = new TourGroup();
        $tours = Tour::toSelectBox();

        return view('admin.tour-group.create', compact('tourGroup', 'tours'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response|RedirectResponse
     */
    public function store(Request $request)
    {
        //
        $params = $request->all();
        $validator = Validator::make($params, [
            'title' => ['required', 'array'],
            'title.uk' => ['required'],
            'title.ru' => ['nullable'],
            'title.en' => ['nullable'],
            'title.pl' => ['nullable'],
            'slug' => ['required', 'array', new TranslatableSlugRule()],
            'slug.uk' => ['required', new UniqueSlugRule('tour_groups', 'slug')],
            'slug.ru' => ['nullable', new UniqueSlugRule('tour_groups', 'slug')],
            'slug.en' => ['nullable', new UniqueSlugRule('tour_groups', 'slug')],
            'slug.pl' => ['nullable', new UniqueSlugRule('tour_groups', 'slug')],
            'text' => ['nullable', 'array'],
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($params);
        }
        $tourGroup = new TourGroup();
        $tourGroup->fill($params);
        $tourGroup->save();

        if (isset($params['tours'])) {
            $tourGroup->tours()->sync($params['tours']);
        }

        return redirect()->route('admin.tour-group.edit', $tourGroup)->withFlashSuccess(__('Record Created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TourGroup $tourGroup
     *
     * @return View
     */
    public function edit(TourGroup $tourGroup)
    {
        //
        $tours = Tour::toSelectBox();
        return view('admin.tour-group.edit', compact('tourGroup', 'tours'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TourGroup $tourGroup
     *
     * @return Response|JsonResponse|RedirectResponse
     */
    public function update(Request $request, TourGroup $tourGroup)
    {
        //
        $params = $request->all();

        if (!$request->ajax()) {
            $validator = Validator::make($params, [
                'title' => ['required', 'array'],
                'title.uk' => ['required'],
                'title.ru' => ['nullable'],
                'title.en' => ['nullable'],
                'title.pl' => ['nullable'],
                'slug' => ['required', 'array', new TranslatableSlugRule()],
                'slug.uk' => ['required', new UniqueSlugRule('tour_groups', 'slug', $tourGroup->id)],
                'slug.ru' => ['nullable', new UniqueSlugRule('tour_groups', 'slug', $tourGroup->id)],
                'slug.en' => ['nullable', new UniqueSlugRule('tour_groups', 'slug', $tourGroup->id)],
                'slug.pl' => ['nullable', new UniqueSlugRule('tour_groups', 'slug', $tourGroup->id)],
                'text' => ['nullable', 'array'],
            ]);
            if ($validator->fails()) {
                return redirect()->route('admin.tour-group.edit', $tourGroup)
                    ->withErrors($validator);
            }
        }

        $tourGroup->fill($params);
        $tourGroup->save();
        
        if (isset($params['tours'])) {
            $tourGroup->tours()->sync($params['tours']);
        }

        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Record Updated')]);
        }
        return redirect()->route('admin.tour-group.edit', $tourGroup)->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TourGroup $tourGroup
     *
     * @return Response
     */
    public function destroy(TourGroup $tourGroup)
    {
        //
        $tourGroup->delete();

        return redirect()->route('admin.tour-group.index')->withFlashSuccess(__('Record Deleted'));
    }

}
