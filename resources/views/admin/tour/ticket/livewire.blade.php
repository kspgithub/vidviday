<div>
    @if($edit)
        @include('admin.tour.ticket.form')
    @endif

    @if(!$edit)
        @include('admin.tour.ticket.list')
    @endif
</div>
