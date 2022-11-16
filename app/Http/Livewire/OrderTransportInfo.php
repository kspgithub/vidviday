<?php

namespace App\Http\Livewire;

use App\Models\AccommodationType;
use App\Models\Order;
use App\Models\OrderNote;
use App\Models\OrderTransport;
use App\Models\PaymentType;
use Livewire\Component;

class OrderTransportInfo extends Component
{
    /**
     * @var Order
     */
    public $order;

    public $orderStatuses = [];


    public $editOrderStatus = false;
    public $orderStatus = '';


    public function mount(OrderTransport $order): void
    {
        $this->order = $order;
        $this->orderStatuses = OrderTransport::statuses();
    }

    public function render()
    {

        return view('admin.order-transport.includes.order-info');
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
