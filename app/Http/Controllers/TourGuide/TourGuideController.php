<?php

namespace App\Http\Controllers\TourGuide;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PopupAd;
use App\Models\Staff;

class TourGuideController extends Controller
{
    public function index()
    {
        //
        $specialists = Staff::published()->whereHas('types', function ($q) {
            return $q->where('slug', 'excursion-leader');
        })->withCount(['testimonials', 'tours'])->get();

        $pageContent = Page::select()->where('key', 'guides')->first();

        $popupAds = PopupAd::query()->whereJsonContains('pages', $pageContent->key)->get();

        return view(
            'tour-guide.index',
            [
                'specialists' => $specialists,
                'pageContent' => $pageContent,
                'popupAds' => $popupAds,
            ]
        );
    }

    public function show($slug)
    {
        $staff = Staff::findBySlugOrFail($slug);
        $staff->loadMissing([
            'testimonials' => function ($q) {
                return $q->moderated();
            },
            'relatedTestimonials' => function ($q) {
                return $q->moderated();
            },
        ]);
        $testimonials = $staff->testimonials->merge($staff->relatedTestimonials)->sortBy(fn ($t) => $t->created_at);
        $tours = $staff->tours()->with('scheduleItems', function ($q) {
            return $q->inFuture();
        })->withAvg('testimonials', 'rating')
            ->withCount(['testimonials' => function ($q) {
                return $q->moderated()
                    ->orderBy('rating', 'desc')
                    ->latest();
            }])->get();

        return view('staff.guide', ['staff' => $staff, 'tours' => $tours, 'testimonials' => $testimonials]);
    }
}
