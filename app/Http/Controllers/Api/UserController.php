<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Models\UserQuestion;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function feedback(FeedbackRequest $request)
    {
        $question = new  UserQuestion();
        $question->fill($request->validated());
        $question->save();
        return response()->json(['result'=>'success', 'message' => __('Thanks for your feedback!')]);
    }
}
