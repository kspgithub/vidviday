@if(in_array('food', $tour->active_tabs))
    <div class="accordion-item">
        <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}"
                                                data-img-src="{{asset('/icon/meal.svg')}}"
                                                alt="meal"></span>@lang('tours-section.food')<i></i></div>
        <div class="accordion-inner">
            <div class="accordion type-2">
                @foreach($tour->group_food_items as $foodDay)
                    <div class="accordion-item active">
                        <div class="accordion-title">{{$foodDay->title}}<i></i></div>
                        <div class="accordion-inner" style="display: block">
                            <div class="accordion type-3">
                                @foreach($foodDay->times as $foodTime)
                                    <div class="accordion-item active">
                                        <div class="accordion-title">{{$foodTime->time->title}}<i></i></div>
                                        <div class="accordion-inner" style="display: block">
                                            <div class="accordion-title">{{$foodTime->title}}<i></i></div>

                                            <x-swiper-media :slides="$foodTime->getMedia()"/>

                                            <div class="text">
                                                {!! $foodTime->text !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
