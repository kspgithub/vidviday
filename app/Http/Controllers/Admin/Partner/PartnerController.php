<?php

namespace App\Http\Controllers\Admin\Partner;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $partners = Partner::query()->get();
        return view('admin.partner.index', ['partners' => $partners]);
    }

    public function create()
    {
        $partner = new Partner();
        $partner->status = 'active';
        $tours = Tour::toSelectBox();
        return view('admin.partner.create', ['partner' => $partner, 'tours' => $tours]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'domain' => ['required'],
            'status' => ['required'],
        ]);

        $partner = new Partner();
        $partner->status = $request->status;
        $partner->title = $request->title;
        $partner->domain = $request->domain;
        $partner->slug = Str::slug($request->domain);
        $partner->token = md5(Str::random());
        $partner->tours = $request->tours ?? [];
        $partner->config = $request->config ?? null;
        $partner->save();

        return redirect()->route('admin.partner.index')->withFlashSuccess(__('Record Created'));
    }


    public function edit(Partner $partner)
    {
        $tours = Tour::toSelectBox();
        return view('admin.partner.edit', ['partner' => $partner, 'tours' => $tours]);
    }

    public function update(Request $request, Partner $partner)
    {
        $partner->status = $request->status;
        $partner->title = $request->title;
        $partner->domain = $request->domain;
        $partner->slug = Str::slug($request->domain);
        if (empty($partner->token)) {
            $partner->token = md5(Str::random());
        }
        $partner->tours = $request->tours ?? [];
        $partner->config = $request->config ?? null;
        $partner->save();
        return redirect()->route('admin.partner.index')->withFlashSuccess(__('Record Updated'));
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->route('admin.partner.index')->withFlashSuccess(__('Record Deleted'));
    }
}
