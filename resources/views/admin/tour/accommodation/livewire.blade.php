<div>
    @if($edit)
        @include('admin.tour.accommodation.form')
    @endif

    @if(!$edit)
        @include('admin.tour.accommodation.list')
    @endif
</div>

