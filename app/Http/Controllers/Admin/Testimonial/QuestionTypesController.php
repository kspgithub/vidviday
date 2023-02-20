<?php

namespace App\Http\Controllers\Admin\Testimonial;

use App\Http\Controllers\Controller;
use App\Models\QuestionType;
use App\Models\Staff;
use App\Models\UserQuestion;
use Illuminate\Http\Request;

class QuestionTypesController extends Controller
{
    public function index()
    {
        $types = [
            UserQuestion::TYPE_CALL => __('Call'),
            UserQuestion::TYPE_EMAIL => __('Email'),
            UserQuestion::TYPE_QUESTION => __('Question'),
            UserQuestion::TYPE_VACANCY => __('Vacancy'),
            UserQuestion::TYPE_CANCEL => __('Cancel'),
        ];

        $questionTypes = QuestionType::query()->get();

        return view('admin.question_types.index', [
            'types' => $types,
            'questionTypes' => $questionTypes,
        ]);
    }

    public function create(QuestionType $questionType)
    {
        $types = arrayToSelectBox([
            UserQuestion::TYPE_CALL => __('Call'),
            UserQuestion::TYPE_EMAIL => __('Email'),
            UserQuestion::TYPE_QUESTION => __('Question'),
            UserQuestion::TYPE_VACANCY => __('Vacancy'),
        ]);

        $managers = Staff::toSelectBox();

        return view('admin.question_types.create', [
            'types' => $types,
            'questionType' => $questionType,
            'managers' => $managers,
        ]);
    }

    public function store(Request $request)
    {
        $questionType = QuestionType::query()->create($request->all());

        return redirect()->route('admin.question_types.index')->withFlashSuccess(__('Типи оновлено'));
    }

    public function edit(QuestionType $questionType)
    {
        $types = arrayToSelectBox([
            UserQuestion::TYPE_CALL => __('Call'),
            UserQuestion::TYPE_EMAIL => __('Email'),
            UserQuestion::TYPE_QUESTION => __('Question'),
            UserQuestion::TYPE_VACANCY => __('Vacancy'),
        ]);

        $managers = Staff::toSelectBox();

        return view('admin.question_types.edit', [
            'types' => $types,
            'questionType' => $questionType,
            'managers' => $managers,
        ]);
    }

    public function update(Request $request, QuestionType $questionType)
    {
        $questionType->update($request->all());

        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Record Updated')]);
        }

        return redirect()->route('admin.question_types.index')->withFlashSuccess(__('Типи оновлено'));
    }

    public function destroy(QuestionType $questionType)
    {
        $questionType->delete();

        return redirect()->route('admin.question_types.index')->withFlashSuccess(__('Типи оновлено'));
    }
}
