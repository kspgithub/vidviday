<div>
    @if($edit)
        @include('admin.tour.transport.form')
    @endif

    @if(!$edit)
        @include('admin.tour.transport.list')
    @endif
</div>
