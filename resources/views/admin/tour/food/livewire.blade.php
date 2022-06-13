<div>
    @if($edit)
        @include('admin.tour.food.form')
    @endif

    @if(!$edit)
        @include('admin.tour.food.list')
    @endif
</div>

