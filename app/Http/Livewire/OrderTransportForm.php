<?php

namespace App\Http\Livewire;

use App\Models\AccommodationType;
use App\Models\Currency;
use App\Models\Order;
use App\Models\OrderTransport;
use App\Models\PaymentType;
use App\Models\Tour;
use App\Models\TourSchedule;
use Illuminate\Validation\Rule;
use Livewire\Component;

class OrderTransportForm extends Component
{
    /**
     * @var OrderTransport
     */
    public $order;

    public $orderStatuses = [];

    public $ageGroups = [];


    public function mount(OrderTransport $order): void
    {
        $this->order = $order;
        $this->orderStatuses = OrderTransport::statuses();
        $this->ageGroups = OrderTransport::ageGroups();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected function rules()
    {
        return [
            'order.status' => Rule::in(array_keys($this->orderStatuses)),
            'order.user_id' => ['nullable', 'integer'],
            'order.start_date' => ['nullable', 'date'],
            'order.end_date' => ['nullable', 'date'],
            'order.places' => ['required', 'integer'],
            'order.duration' => ['nullable', 'integer'],
            'order.route' => ['nullable', 'string'],
            'order.age_group' => ['nullable', 'array'],
            'order.first_name' => ['required', 'string'],
            'order.last_name' => ['required', 'string'],
            'order.phone' => ['required', 'string'],
            'order.email' => ['required', 'email'],
            'order.viber' => ['nullable', 'string'],
            'order.comment' => ['nullable', 'string'],

        ];
    }

    public function render()
    {
        return view('admin.order-transport.includes.order-form');
    }

    public function save()
    {
        $this->validate();
        $this->order->save();
        session()->flash('success', __('Record Updated'));
    }
}
