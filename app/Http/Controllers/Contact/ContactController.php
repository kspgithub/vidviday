<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialAnswerRequest;
use App\Http\Requests\Tour\TestimonialRequest;
use App\Models\Contact;
use App\Models\Staff;
use App\Models\Page;
use App\Models\Testimonial;
use App\Models\Tour;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        //
        $contact = Contact::first();
        $pageContent = Page::query()->where('key', 'our-contacts')->first();

        $specCorporate = Staff::whereHas('types', function ($q) {
            return $q->where('slug', 'corporate-order');
        })->withCount(['testimonials' => function ($q) {
            return $q->moderated();
        }])->get();

        $specAgencies = Staff::whereHas('types', function ($q) {
            return $q->where('slug', 'travel-agencies');
        })->withCount(['testimonials' => function ($q) {
            return $q->moderated();
        }])->get();

        return view('contact.index', [
            'contact' => $contact,
            'pageContent' => $pageContent,
            'specCorporate' => $specCorporate,
            'specAgencies' => $specAgencies
        ]);
    }

}