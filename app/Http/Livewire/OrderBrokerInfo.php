<?php

namespace App\Http\Livewire;

use App\Models\AccommodationType;
use App\Models\Order;
use App\Models\OrderNote;
use App\Models\OrderBroker;
use App\Models\PaymentType;
use Livewire\Component;

class OrderBrokerInfo extends Component
{
    /**
     * @var Order
     */
    public $order;

    public $orderStatuses = [];


    public $editOrderStatus = false;
    public $orderStatus = '';


    public function mount(OrderBroker $order): void
    {
        $this->order = $order;
        $this->orderStatuses = OrderBroker::statuses();
    }

    public function render()
    {

        return view('admin.order-broker.includes.order-info');
    }

    public function changeStatus()
    {
        $this->orderStatus = $this->order->status;
        $this->editOrderStatus = true;
    }

    public function saveStatus()
    {
        $this->editOrderStatus = false;
        $this->order->status = (int)$this->orderStatus;
        $this->order->save();
    }

    public function cancelStatus()
    {
        $this->editOrderStatus = false;
    }


}
