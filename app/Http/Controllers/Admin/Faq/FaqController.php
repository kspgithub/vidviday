<?php

namespace App\Http\Controllers\Admin\Faq;

use App\Http\Controllers\Controller;
use App\Models\FaqItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index($section = 'corporate')
    {
        //
        $faqitems = FaqItem::query()->where('section', $section)->orderBy('sort_order')->get();

        return view('admin.faqitem.index', compact('faqitems', 'section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create($section)
    {
        //
        $faqItem = new FaqItem();
        $faqItem->published = 1;
        $faqItem->section = $section;

        return view('admin.faqitem.create', ['faqitem' => $faqItem, 'section' => $section]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request  $request
     *
     * @return Response
     */
    public function store(Request $request, $section)
    {
        $faqitem = new FaqItem();
        $faqitem->fill($request->all());
        $faqitem->save();

        return redirect()->route('admin.faqitem.index', $section)->withFlashSuccess(__('Record Created'));
    }

    /**
     * @param $section
     * @param FaqItem  $faqItem
     *
     * @return View
     */
    public function edit($section, FaqItem $faqItem)
    {
        //
        return view('admin.faqitem.edit', ['faqitem' => $faqItem, 'section' => $section]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request  $request
     * @param FaqItem  $faqitem
     *
     * @return Response|JsonResponse
     */
    public function update(Request $request, $section, FaqItem $faqItem)
    {
        //
        $faqItem->fill($request->all());
        $faqItem->save();
        if ($request->ajax()) {
            return response()->json(['result' => 'success']);
        }

        return redirect()->route('admin.faqitem.index', $section)->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FaqItem  $faqitem
     *
     * @return Response
     */
    public function destroy($section, FaqItem $faqItem)
    {
        //
        $faqItem->delete();

        return redirect()->route('admin.faqitem.index', $section)->withFlashSuccess(__('Record Deleted'));
    }

    public function sort(Request $request)
    {
        $ids = $request->input('order', []);
        foreach ($ids as $position => $id) {
            FaqItem::whereId($id)->update(['sort_order' => $position]);
        }

        return response()->json(['result' => 'success']);
    }
}
