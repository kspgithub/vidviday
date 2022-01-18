<div x-data='crmOrderCollective({
    order: @json($order),
    statuses: @json($statuses),
    roomTypes: @json($roomTypes),
})'>
    <form action="{{$order->id > 0 ? route('admin.crm.order.update', $order) : route('admin.crm.order.store')}}"
          @submit="onSubmit"
          @change="onFormChange"
          method="POST">
        @csrf
        @if($order->id > 0)
            @method('PATCH')
        @endif
        <input type="hidden" name="group_type" value="0">
        @include('admin.crm.order.includes.customer-form')
        @include('admin.crm.order.includes.schedule-form')
        @include('admin.crm.order.includes.participants-form')
        @include('admin.crm.order.includes.accomm-form')
        @include('admin.crm.order.includes.finance-form')
        @include('admin.crm.order.includes.agency-form')
        @include('admin.crm.order.includes.other-form')

        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>

</div>