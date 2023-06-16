<div x-data='crmOrderCollective({
    order: @json($order),
    tour: @json($tour),
    schedule: @json($schedule),
    statuses: @json($statuses),
    roomTypes: @json($roomTypes),
    availableDiscounts: @json($availableDiscounts??[]),
})'>
    <form action="{{$order->id > 0 ? route('admin.crm.order.update', $order) : route('admin.crm.order.store')}}"

          @change="onFormChange"
          x-ref="form"
          method="POST">
        @if(app()->environment('local'))
            <a href="#" @click.prevent="fillForm">fillForm</a>
        @endif
        @csrf
        @if($order->id > 0)
            @method('PATCH')
        @endif
        <input type="hidden" name="group_type" value="0">
        @include('admin.crm.order.includes.abolition-card')
        @include('admin.crm.order.includes.customer-form')
        @include('admin.crm.order.includes.agency-form')
        @include('admin.crm.order.includes.schedule-form')
        @include('admin.crm.order.includes.participants-form')
        @include('admin.crm.order.includes.accomm-form')
        @include('admin.crm.order.includes.finance-form')
        @include('admin.crm.order.includes.other-form')

        <button type="submit" class="btn btn-primary" @click.prevent="onSubmit">Зберегти</button>
    </form>

</div>
