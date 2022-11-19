<?php

namespace App\Http\Livewire;

use App\Models\AccommodationType;
use App\Models\Currency;
use App\Models\Order;
use App\Models\OrderBroker;
use App\Models\PaymentType;
use App\Models\Tour;
use App\Models\TourSchedule;
use Illuminate\Validation\Rule;
use Livewire\Component;

class OrderBrokerForm extends Component
{
    /**
     * @var OrderBroker
     */
    public $order;

    public $orderStatuses = [];


    public function mount(OrderBroker $order): void
    {
        $this->order = $order;
        $this->orderStatuses = OrderBroker::statuses();
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
        return view('admin.order-broker.includes.order-form');
    }

    public function save()
    {
        $this->validate();
        $this->order->save();
        session()->flash('success', __('Record Updated'));
    }
}
