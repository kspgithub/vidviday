<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Lib\Bitrix24\CRM\Lead\LeadFeedback;
use App\Models\AgencySubscription;
use App\Models\UserQuestion;
use App\Models\UserSubscription;
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
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $file_name = md5(time() . rand(0, 1000)) . '.' . $file->getClientOriginalExtension();
            $question->attachment_name = $file->getClientOriginalName();
            $question->attachment = $file->storeAs('public/uploads/user', $file_name);
        }
        $question->save();
//        try {
//            LeadFeedback::createCrmLead($question);
//        } catch (Exception $e) {
//            Log::error($e->getMessage(), $e->getTrace());
//        }

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


    public function subscription(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $subscription = UserSubscription::whereEmail($request->email)->first();
        if ($subscription == null) {
            $subscription = new UserSubscription();
        }
        $subscription->fill($request->all());
        $subscription->status = UserSubscription::STATUS_ACTIVE;
        $subscription->save();
//        try {
//            LeadFeedback::createCrmLead($subscription);
//        } catch (Exception $e) {
//            Log::error($e->getMessage(), $e->getTrace());
//        }
        return response()->json(['result' => 'success', 'message' => __('Thanks for subscribing!')]);
    }

    public function agentSubscription(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $subscription = AgencySubscription::whereEmail($request->email)->first();
        if ($subscription == null) {
            $subscription = new AgencySubscription();
        }
        $subscription->fill($request->all());
        $subscription->status = UserSubscription::STATUS_ACTIVE;
        $subscription->save();

//        try {
//            LeadFeedback::createCrmLead($subscription);
//        } catch (Exception $e) {
//            Log::error($e->getMessage(), $e->getTrace());
//        }
        return response()->json(['result' => 'success', 'message' => __('Thanks for subscribing!')]);
    }
}
