<div class="accordion-item">
    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}"
                                            data-img-src="{{asset('/icon/wallet.svg')}}"
                                            alt="wallet"></span>@lang('tours-section.finances')<i></i></div>
    <div class="accordion-inner">
        <div class="accordion type-2">
            @foreach($tour->group_tour_includes as $idx => $type)
                @if($type->items->count() > 0)
                    <div class="accordion-item active">
                        <div class="accordion-title">{{$type->title}}<i></i></div>
                        <div class="accordion-inner" style="display: block">
                            <div class="text text-md pb-1">
                                @foreach($type->items as $tour_include)
                                    @if($tour_include->finance)
                                        {!! $tour_include->finance->text !!}
                                    @else
                                        {!! $tour_include->text !!}
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            @if($tour->discounts->count() > 0)
                <div class="accordion-item active">
                    <div class="accordion-title">{{__('Discounts')}}<i></i></div>
                    <div class="accordion-inner" style="display: block">
                        <div class="text text-md pb-1">
                            <ul>
                                @foreach($tour->discounts as $discount)
                                    <li>{!! $discount->title !!}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
