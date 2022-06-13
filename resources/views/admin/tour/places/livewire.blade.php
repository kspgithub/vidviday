<div>
    @if($edit)
        @include('admin.tour.places.form')
    @endif

    @if(!$edit)
        @include('admin.tour.places.list')
    @endif
</div>

