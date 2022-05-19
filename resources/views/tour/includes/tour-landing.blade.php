<div class="accordion-item">
    <div class="accordion-title">
        <span class="accordion-icon">{{svg('bus')}}</span> @lang('tours-section.landing-places')<i></i>
    </div>
    <div class="accordion-inner">
        <div class="accordion type-2">
            @foreach($tour->landings as $landing)
                <div class="accordion-item">
                    <div class="accordion-title">{{$landing->title}}<i></i></div>
                    <div class="accordion-inner">
                        <div class="text text-md">
                            {!! $landing->description !!}
                        </div>

                        <div v-is="'map-route'"
                             :lat='{{$landing->lat?:0}}'
                             :lng='{{$landing->lng?:0}}'
                             marker='/img/marker-bus.png'
                             :address='"{{$landing->title}}"'
                        ></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
