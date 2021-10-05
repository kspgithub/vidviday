<div class="accordion-item">
    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}"
                                            data-img-src="{{asset('/icon/wallet.svg')}}"
                                            alt="wallet"></span>Фінанси<i></i></div>
    <div class="accordion-inner">
        <div class="accordion type-2">
            @foreach($tour->group_tour_includes as $idx => $type)
                @if($type->items->count() > 0)
                    <div class="accordion-item active">
                        <div class="accordion-title">{{$type->title}}<i></i></div>
                        <div class="accordion-inner" style="display: block">
                            <div class="text text-md pb-1">
                                <ul>
                                    @foreach($type->items as $tour_include)
                                        <li>{{$tour_include->title}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
