<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
use App\Models\AccommodationType;
use App\Models\Currency;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\QuestionType;
use App\Models\Staff;
use App\Models\Tour;
use App\Models\TourSchedule;
use App\Models\UserQuestion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Models\Audit;

class CrmCanceledOrderController extends Controller
{
    public function index(Request $request)
    {
        $abolitionTypes = QuestionType::query()->where('type', UserQuestion::TYPE_CANCEL)
            ->published()
            ->pluck('title', 'id');

        $canceledOrders = Order::query()->where('status', Order::STATUS_CANCELED)
            ->whereNotNull('abolition')
            ->where(function (Builder $q) use ($abolitionTypes) {
                foreach ($abolitionTypes as $type => $title) {
                    $q->orWhereJsonContains('abolition->cause', $type);
                }
                return $q;
            })
            ->get()
            ->groupBy('abolition.cause');

        return view('admin.crm.order.cancel', [
            'abolitionTypes' => $abolitionTypes,
            'canceledOrders' => $canceledOrders,
        ]);
    }
}
