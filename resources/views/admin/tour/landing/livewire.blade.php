<div>
    @if($edit)
        @include('admin.tour.landing.form')
    @endif

    @if(!$edit)
        @include('admin.tour.landing.list')
    @endif
</div>
