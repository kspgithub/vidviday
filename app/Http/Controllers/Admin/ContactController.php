<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    /**
     *
     * @param Contact  $contact
     *
     * @return View
     */
    public function edit()
    {
        //
        $contact = Contact::first();

        if($contact === null)
        {$contact = new Contact();}
        return view('admin.contact.edit', ['contact'=>$contact]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Contact  $contact
     *
     * @return Response
     */
    public function update(Request $request)
    {
        //
        $contact = Contact::first();

        if($contact === null)
        {$contact = new Contact();}
        $contact->fill($request->all());
        $contact->save();

        return redirect()->route('admin.contact.edit')->withFlashSuccess(__('Contact updated.'));
    }

}
