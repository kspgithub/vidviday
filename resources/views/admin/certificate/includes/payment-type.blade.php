@switch($order->payment_status )
    @case(\App\Models\OrderCertificate::PAYMENT_PENDING)
    <span class='badge bg-warning'>@lang('Pending')</span>
    @break
    @case(\App\Models\OrderCertificate::PAYMENT_COMPLETE)
    <span class='badge bg-success'>@lang('Payed')</span>
    @break
    @case(\App\Models\OrderCertificate::PAYMENT_RETURNED)
    <span class='badge bg-danger'>@lang('Returned')</span>
    @break
@endswitch


@switch($order->payment_type )
    @case(1)
    <span>За реквизитами (фіз. лице)</span>
    @break
    @case(2)
    <span>За реквизитами (ФОП, Юр. лице, з ПДВ)</span>
    @break
    @case(3)
    <span>За реквизитами (ФОП, Юр. лице, без ПДВ)</span>
    @break
    @case(4)
    <span>В офісі</span>
    @break
    @case(5)
    <span>Онлайн оплата</span>
    @break
    @case(0)
    <span>Не вибрано</span>
    @break
@endswitch
