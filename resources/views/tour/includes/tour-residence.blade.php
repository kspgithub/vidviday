<div class="accordion-item">
    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}"
                                            data-img-src="{{asset('/icon/keys.svg')}}"
                                            alt="keys"></span>@lang('tours-section.accommodation')<i></i></div>
    <div class="accordion-inner">
        <div class="accordion type-2">
            @foreach($tour->groupTourAccommodations as $residence)
                <div class="accordion-item">
                    <div class="accordion-title">{{$residence->title}} <i></i></div>
                    <div class="accordion-inner">
                        <x-swiper-media :slides="$residence->media"/>

                        <div class="text text-md">
                            <p>{!! $residence->text!!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
