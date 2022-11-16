<?php

namespace App\Http\Livewire;

use App\Models\AccommodationType;
use App\Models\Order;
use App\Models\OrderNote;
use App\Models\PaymentType;
use Livewire\Component;

class OrderInfo extends Component
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

    public $noteText = '';

    public $editOrderStatus = false;
    public $orderStatus = 0;
    public $orderStatusNotice = 0;

    public $editConfirmationStatus = false;
    public $confirmationStatus = 0;

    public $editPaymentStatus = false;
    public $paymentStatus = 0;


    public function mount(Order $order): void
    {
        $this->order = $order;

        $this->roomTypes = AccommodationType::toSelectArray('title', 'slug');
        $this->paymentTypes = PaymentType::toSelectArray();
        $this->orderStatuses = Order::statuses();
        $this->paymentStatuses = Order::$paymentStatuses;
        $this->confirmationTypes = Order::$confirmations;
    }

    public function render()
    {
        $notes = OrderNote::where('order_id', $this->order->id)->orderBy('created_at')->get();
        return view('admin.order.includes.order-info', ['notes'=>$notes]);
    }


    public function addNote()
    {
        $note = new OrderNote();
        $note->order_id = $this->order->id;
        $note->text = $this->noteText;
        $note->save();
        $this->noteText = '';
    }

    public function deleteNote($id)
    {
        $note = OrderNote::find($id);
        $note->delete();
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

        if ((int)$this->orderStatusNotice === 1) {
            //TODO: Уведомляем пользователя о смене статуса
        }
        $this->orderStatusNotice = 0;
    }

    public function cancelStatus()
    {
        $this->editOrderStatus = false;
    }


    public function changeConfirmationStatus()
    {
        $this->confirmationStatus = $this->order->confirmation_status;
        $this->editConfirmationStatus = true;
    }

    public function saveConfirmationStatus()
    {
        $this->editConfirmationStatus = false;
        $this->order->confirmation_status = (int)$this->confirmationStatus;
        $this->order->save();
    }

    public function cancelConfirmationStatus()
    {
        $this->editConfirmationStatus = false;
    }

    public function changePaymentStatus()
    {
        $this->paymentStatus = $this->order->payment_status;
        $this->editPaymentStatus = true;
    }

    public function savePaymentStatus()
    {
        $this->editPaymentStatus = false;
        $this->order->payment_status = (int)$this->paymentStatus;
        $this->order->save();
    }

    public function cancelPaymentStatus()
    {
        $this->editPaymentStatus = false;
    }
}
