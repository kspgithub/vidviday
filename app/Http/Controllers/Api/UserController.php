<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Lib\Bitrix24\CRM\Lead\LeadFeedback;
use App\Models\UserQuestion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    //
    public function data()
    {
        return current_user();
    }


    public function feedback(FeedbackRequest $request)
    {
        $question = new  UserQuestion();
        $question->fill($request->validated());
        $question->save();
        try {
            LeadFeedback::createCrmLead($question);
        } catch (Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
        }

        return response()->json(['result' => 'success', 'message' => __('Thanks for your feedback!')]);
    }


    public function favourites()
    {
        $user = current_user();
        if ($user) {
            return array_values($user->tourFavourites()->get(['id'])->pluck('id')->toArray());
        }
        return [];
    }

    public function favouritesToggle($id)
    {
        $user = current_user();
        if ($user) {
            $user->tourFavourites()->toggle($id);
            return array_values($user->tourFavourites()->get(['id'])->pluck('id')->toArray());
        }
        return [];
    }
}
