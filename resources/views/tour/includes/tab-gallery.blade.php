<div class="tab active">
    <div class="spacer-xs"></div>
    @include('tour.includes.sorting')
    <div class="spacer-xs"></div>
    <!-- THUMBS -->
    <div class="thumb-wrap row">
        @foreach($tours as $tour)
            <div class="col-lg-4 col-sm-6 col-12">
                <x-tour.card :tour="$tour"/>
            </div>
        @endforeach

        <div class="col-12">
            <div class="spacer-xs"></div>
            <div class="text-center">
                <x-seo-button :code="'tour.show_more'" class="btn type-2">Показати ще 12</x-seo-button>
            </div>
        </div>
    </div>
    <!-- THUMBS END -->
</div>
