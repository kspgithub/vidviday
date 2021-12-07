@if($order->type == \App\Models\OrderCertificate::TYPE_TOUR)
    <div><b>Тур:</b> {{$order->tour->title}}</div>
    <div><b>Місць:</b> {{$order->places}}</div>
@endif
@if($order->type == \App\Models\OrderCertificate::TYPE_SUM)
    <div><b>Сумма:</b> {{$order->sum}} {{$order->currency}}</div>
@endif
<div>
    <b>Формат:</b>
    {{$order->format === \App\Models\OrderCertificate::FORMAT_PRINTED ? 'Друкований' : 'Електронний'}}
</div>
<div>
    <b>Дизайн:</b>
    {{$order->design === \App\Models\OrderCertificate::DESIGN_HEART ? 'Серце' : 'Класичний'}}
</div>
<div>
    <b>Пакування:</b>
    {{$order->packing ? $order->packingItem->title  : 'Ні'}}
</div>
