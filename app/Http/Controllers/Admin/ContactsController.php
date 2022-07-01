<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactsController extends Controller
{

    /**
     * @return View
     */
    public function edit()
    {
        //
        $contact = Contact::first();

        if ($contact === null) {
            $contact = new Contact();
        }
        return view('admin.contact.edit', ['contact' => $contact]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function update(Request $request)
    {
        //
        $contact = Contact::first();

        if ($contact === null) {
            $contact = new Contact();
        }
        $contact->fill($request->all());
        $contact->save();

        return redirect()->route('admin.contact.edit')->withFlashSuccess(__('Контакти оновлено'));
    }
}
