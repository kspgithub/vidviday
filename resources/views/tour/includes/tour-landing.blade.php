@if(count($tour->groupTourLandings))
    @if(true || in_array('landings', $tour->active_tabs))
        <div class="accordion-item hidden-print">
            <div class="accordion-title">
                <span class="accordion-icon">{{svg('bus')}}</span>
                @lang('tours-section.landing-places')
                <i></i>
            </div>
            <div class="accordion-inner">
                <div class="accordion type-2">
                    @if($sync = true)
                        @foreach($tour->groupTourLandings as $landing)
                            <div class="accordion-item">
                                <div class="accordion-title">
                                    {{$landing->title}}
                                    @if($landing->time)
                                        <span>({{ $landing->time }})</span>
                                    @endif
                                    <i></i>
                                </div>
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
                    @endif
                </div>
            </div>
        </div>
    @endif
@endif
