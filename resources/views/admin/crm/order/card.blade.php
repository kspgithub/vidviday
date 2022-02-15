<div>
    @include('admin.crm.order.includes.basic')
    @include('admin.crm.order.includes.participants')
    @include('admin.crm.order.includes.agency')
    @include('admin.crm.order.includes.finance')
    @include('admin.crm.order.includes.additional')

    @include('admin.crm.notify.email-modal')
    @include('admin.crm.order.includes.audit')
</div>
