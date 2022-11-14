<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Page;

class ContactController extends Controller
{
    public function index()
    {
        //
        $contact = Contact::first();
        $pageContent = Page::query()->where('key', 'our-contacts')->first();

        $specCorporate = $contact->manager_corporate_items;

        $specAgencies = $contact->manager_agency_items;

        return view('contact.index', [
            'contact' => $contact,
            'pageContent' => $pageContent,
            'specCorporate' => $specCorporate,
            'specAgencies' => $specAgencies,
        ]);
    }
}
