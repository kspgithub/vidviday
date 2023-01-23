<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PopupMessage;
use Illuminate\Http\Request;

class PopupMessageController extends Controller
{
    public function index()
    {
        $popupMessages = PopupMessage::query()->get();

        return view('admin.popup-messages.index', [
            'popupMessages' => $popupMessages,
        ]);
    }

    public function save(Request $request)
    {
        $messages = $request->get('messages', []);

        foreach ($messages as $type => $message) {
            $model = PopupMessage::query()->where('type', $type)->first();

            if($model) {
                $model->update($message);
            }
        }

        return redirect()->route('admin.popup-messages')->withFlashSuccess(__('Record Updated'));
    }
}
