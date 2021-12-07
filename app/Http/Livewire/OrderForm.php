<?php

namespace App\Http\Livewire;

use App\Models\AccommodationType;
use App\Models\Currency;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\Tour;
use App\Models\TourSchedule;
use Illuminate\Validation\Rule;
use Livewire\Component;

class OrderForm extends Component
{
    /**
     * @var Order
     */
    public $order;

    public $orderStatuses = [];

    public $roomTypes = [];

    public $paymentTypes = [];

    public $paymentStatuses = [];

    public $confirmationTypes = [];

    public $includeTypes = [];


    public $currencies = [];


    public $discounts = [];

    public $discountTitle = '';
    public $discountValue = '';


    public $participants = [];


    public $participantPhone = '';
    public $participantFirstName = '';
    public $participantLastName = '';
    public $participantMiddleName = '';
    public $participantBirthday = '';

    public $accommodation = [];

    public $priceInclude = [];


    public function mount(Order $order): void
    {
        $this->order = $order;
        $this->discounts = $this->order->discounts ?? [];
        $this->accommodation = $this->order->accommodation ?? [];
        $this->participants = !empty($this->order->participants) && !empty($this->order->participants['items'])
            ? $this->order->participants['items'] : [];

        $this->participantPhone = !empty($this->order->participants) && !empty($this->order->participants['participant_phone'])
            ? $this->order->participants['participant_phone'] : '';

        $this->priceInclude = $this->order->price_include ?? [];

        $this->roomTypes = AccommodationType::all();
        $this->paymentTypes = PaymentType::toSelectArray();
        $this->orderStatuses = Order::statuses();
        $this->includeTypes = Order::includes();
        $this->paymentStatuses = Order::$paymentStatuses;
        $this->confirmationTypes = Order::$confirmations;
        $this->currencies = Currency::toSelectArray('iso', 'iso');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected function rules()
    {
        return [
            'order.status' => Rule::in(array_keys($this->orderStatuses)),
            'order.group_type' => [Rule::in([0, 1])],
            'order.program_type' => [Rule::in([0, 1])],
            'order.user_id' => ['nullable', 'integer'],
            'order.tour_id' => ['nullable', 'integer'],
            'order.schedule_id' => ['nullable', 'integer'],
            'order.start_date' => ['nullable', 'date'],
            'order.end_date' => ['nullable', 'date'],
            'order.start_place' => ['nullable'],
            'order.end_place' => ['nullable'],
            'order.places' => ['required', 'integer'],
            'order.children' => ['nullable'],
            'order.children_young' => ['nullable', 'integer'],
            'order.children_older' => ['nullable', 'integer'],
            'order.currency' => ['required', Rule::in(array_keys($this->currencies))],
            'order.price' => ['required', 'integer'],
            'order.commission' => ['required', 'integer'],
            'order.discount' => ['required', 'integer'],
            'order.first_name' => ['required', 'string'],
            'order.last_name' => ['required', 'string'],
            'order.phone' => ['required', 'string'],
            'order.email' => ['required', 'email'],
            'order.viber' => ['nullable', 'string'],
            'order.company' => ['nullable', 'string'],
            'order.comment' => ['nullable', 'string'],
            'order.group_comment' => ['nullable', 'string'],
            'order.program_comment' => ['nullable', 'string'],

            'order.offer_date' => ['nullable', 'date'],
            'order.confirmation_type' => ['nullable', Rule::in([0, 1, 2, 3])],
            'order.confirmation_status' => ['nullable', Rule::in([0, 1, 2])],
            'order.confirmation_contact' => ['nullable', 'string'],

            'order.payment_type' => ['nullable', Rule::in(array_keys($this->paymentTypes))],
            'order.payment_status' => ['nullable', Rule::in([0, 1, 2])],

        ];
    }

    public function getTourProperty()
    {
        return Tour::find($this->order->tour_id);
    }

    public function getSchedulesProperty()
    {
        return TourSchedule::where('tour_id', $this->order->tour_id)->get();
    }

    public function getTotalProperty()
    {
        return $this->order->price - $this->order->discount + $this->order->commission;
    }

    public function render()
    {
        return view('admin.order.includes.order-form');
    }


    public function addDiscount()
    {
        $discountValue = (int)$this->discountValue;
        $this->discounts[] = [
            'title' => $this->discountTitle,
            'value' => $discountValue,
        ];
        $this->discountTitle = '';
        $this->discountValue = '';

        $this->order->discount += $discountValue;
    }

    public function removeDiscount($index)
    {
        $discountValue = (int)$this->discounts[$index]['value'];
        $this->order->discount -= $discountValue;
        unset($this->discounts[$index]);
    }

    public function addParticipant()
    {
        $this->participants[] = [
            'first_name' => $this->participantFirstName ?? '',
            'last_name' => $this->participantLastName ?? '',
            'middle_name' => $this->participantMiddleName ?? '',
            'birthday' => $this->participantBirthday ?? '',
        ];
        $this->participantFirstName = '';
        $this->participantLastName = '';
        $this->participantMiddleName = '';
        $this->participantBirthday = '';
    }

    public function removeParticipant($index)
    {
        unset($this->participants[$index]);
    }


    public function save()
    {
        $this->validate();

        $this->order->participants = [
            'items' => $this->participants,
            'participant_phone' => $this->participantPhone,
        ];
        $this->order->price_include = $this->priceInclude;
        $this->order->accommodation = $this->accommodation;
        $this->order->discounts = $this->discounts;

        $this->order->save();
        session()->flash('success', __('Record Updated'));
    }
}
