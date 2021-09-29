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
        $pageContent = Page::query()->where('slug', 'our-contacts')->first();

        $specialists = Staff::whereHas('types', function ($q) {
            return $q->where('slug', 'booking-manager');
        })->get();

        $specs = Staff::whereHas('types', function ($q) {
            return $q->where('slug', 'excursion-leader');
        })->get();

        return view('contact.index', [
            'contact' => $contact,
            'pageContent' => $pageContent,
            'specialists' => $specialists,
            'specs' => $specs
        ]);
    }

}
