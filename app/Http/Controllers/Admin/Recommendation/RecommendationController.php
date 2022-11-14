<?php

namespace App\Http\Controllers\Admin\Recommendation;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecommendationRequest;
use App\Models\Page;
use App\Models\Recommendation;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index(Request $request, Page $page)
    {
        $recommendations = $page->recommendations()->paginate(10);

        return view('admin.recommendation.index', compact('page', 'recommendations'));
    }

    public function create(Request $request, Page $page)
    {
        $recommendation = new Recommendation();
        $recommendation->rating = 5;

        return view('admin.recommendation.create', compact('page', 'recommendation'));
    }

    public function store(RecommendationRequest $request, Page $page)
    {
        $recommendation = new Recommendation();
        $recommendation->fill($request->validated());
        $recommendation->page_id = $page->id;
        $recommendation->save();
        if ($request->hasFile('avatar_upload')) {
            $recommendation->uploadAvatar($request->file('avatar_upload'));
        }

        return redirect()->route('admin.page.recommendation.edit', [$page, $recommendation])->withFlashSuccess(__('Record Created'));
    }

    public function edit(Request $request, Page $page, Recommendation $recommendation)
    {
        return view('admin.recommendation.edit', compact('page', 'recommendation'));
    }

    public function update(RecommendationRequest $request, Page $page, Recommendation $recommendation)
    {
        $recommendation->fill($request->validated());
        $recommendation->save();
        if ($request->hasFile('avatar_upload')) {
            $recommendation->uploadAvatar($request->file('avatar_upload'));
        }

        return redirect()->route('admin.page.recommendation.edit', [$page, $recommendation])->withFlashSuccess(__('Record Updated'));
    }

    public function destroy(Request $request, Page $page, Recommendation $recommendation)
    {
        $recommendation->deleteAvatar();
        $recommendation->save();

        return redirect()->route('admin.page.recommendation.index', $page)->withFlashSuccess(__('Record Deleted'));
    }

    public function sort(Request $request)
    {
        $ids = $request->input('order', []);
        foreach ($ids as $position => $id) {
            Recommendation::whereId($id)->update(['sort_order' => $position]);
        }

        return response()->json(['result' => 'success']);
    }
}
