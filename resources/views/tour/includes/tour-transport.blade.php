<div class="accordion-item">
    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}"
                                            data-img-src="{{asset('/icon/keys.svg')}}"
                                            alt="keys"></span>@lang('tours-section.transport')<i></i></div>
    <div class="accordion-inner">
        <div class="accordion type-2">
            @foreach($tour->transports as $transport)
                <div class="accordion-item">
                    <div class="accordion-title">{{$transport->title}} <i></i></div>
                    <div class="accordion-inner">
                        <img src="{{$transport->image_url}}" alt="{{$transport->image_alt}}" style="width: 50%;">

                        <div class="text text-md">
                            <p>{!! $transport->text!!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
