<div class="tab only-desktop">
    <div class="spacer-xs"></div>
    @include('tour.includes.sorting')
    <div class="spacer-xs"></div>

    <div class="tour-container">
        @foreach($tours as $tour)
            <x-tour.card :tour="$tour" mode="item"/>

        @endforeach
    </div>


    <div class="text-center">
        <div class="spacer-xs"></div>
        <span v-bind="$buttons('tour.show_more')" class="btn type-2">@lang('tours-section.show-more-12')</span>
    </div>
</div>
