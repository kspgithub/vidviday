<div class="accordion-item">
    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}"
                                            data-img-src="{{asset('/icon/meal.svg')}}"
                                            alt="meal"></span>Харчування<i></i></div>
    <div class="accordion-inner">
        <div class="accordion type-2">
            @foreach($tour->group_food_items as $foodDay)
                <div class="accordion-item">
                    <div class="accordion-title">{{$foodDay->title}}<i></i></div>
                    <div class="accordion-inner">
                        <div class="accordion type-3">
                            @foreach($foodDay->times as $foodTime)
                                <div class="accordion-item">
                                    <div class="accordion-title">{{$foodTime->time->title}}<i></i></div>
                                    <div class="accordion-inner">
                                        <x-swiper-media :slides="$foodTime->getMedia()"/>

                                        <div class="text">
                                            <p>{{$foodTime->text}}</p>
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
