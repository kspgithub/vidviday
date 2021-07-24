<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqItem;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $faqitems = FaqItem::select(['id','section','question','answer', 'sort_order', 'published'])->get();
        return view('admin.faqitem.index', compact('faqitems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $faqitem = new FaqItem();
        return view('admin.faqitem.create', ['faqitem'=>$faqitem]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $faqitem = new FaqItem();
        $faqitem->fill($request->all());
        $faqitem->save();

        return redirect()->route('admin.faqitem.index')->withFlashSuccess(__('FaqItem created.'));
    }

    /**
     *
     * @param FaqItem  $faqitem
     *
     * @return View
     */
    public function edit(FaqItem  $faqitem)
    {
        //
        return view('admin.faqitem.edit', ['faqitem'=>$faqitem]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param FaqItem  $faqitem
     *
     * @return Response
     */
    public function update(Request $request, FaqItem $faqitem)
    {
        //
        $faqitem->fill($request->all());
        $faqitem->save();

        return redirect()->route('admin.faqitem.index')->withFlashSuccess(__('FaqItem updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FaqItem $faqitem
     *
     * @return Response
     */
    public function destroy(FaqItem $faqitem)
    {
        //
        $faqitem->delete();

        return redirect()->route('admin.faqitem.index')->withFlashSuccess(__('FaqItem deleted.'));
    }
}
