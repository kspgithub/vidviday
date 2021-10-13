<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Staff;
use App\Models\Page;

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
