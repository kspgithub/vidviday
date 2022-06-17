<div>
    @if($edit)
        @include('admin.tour.discount.form')
    @endif

    @if(!$edit)
        @include('admin.tour.discount.list')
    @endif
</div>
