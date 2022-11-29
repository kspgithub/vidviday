<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Lib\Bitrix24\CRM\Lead\LeadFeedback;
use App\Models\AgencySubscription;
use App\Models\UserQuestion;
use App\Models\UserSubscription;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageTypesController extends Controller
{
    private function getModelQuery($type) {
        $model = app($type);

        if(!($model instanceof Model)) {
            abort(404);
        }

        return $model::query();
    }

    public function index(Request $request)
    {
        $q = $request->input('q', '');

        $query = $this->getModelQuery($request->get('type'));

        $locale = app()->getLocale();

        if($q) {
            $query->jsonLike('title', '%'.$q.'%');
        }

        if($request->paginate) {
            $paginator = $query->paginate($request->input('limit', 10));
            $items = [];
            foreach ($paginator->items() as $item) {
                $items[] = $item->asSelectBox();
            }

            return [
                'results' => $items,
                'pagination' => [
                    'more' => $paginator->hasMorePages()
                ]
            ];
        }

        return $query->toSelectBox();
    }
}
