@props([
    'tour'=> new \App\Models\Tour(),
])
@if($tour->tour_manager)
    <div class="sidebar-item notice">
        <div class="top-part">
            <div class="title h3 light title-icon">
                <img src="{{asset('/img/preloader.png')}}"
                     data-img-src="{{asset('/icon/headphones.svg')}}"
                     alt="headphones">Менеджер туру
            </div>
        </div>
        <div class="bottom-part">
            <span class="text-md text-medium">{{$tour->tour_manager->name}}</span>
            <div class="spacer-xs"></div>
            <div>
                @foreach($tour->tour_manager->phones as $phone)
                    <a href="tel:+{{clear_phone($phone)}}" class="text">{{$phone}}</a>
                    <br>
                @endforeach
                @if($tour->tour_manager->email)
                    <div class="spacer-xs"></div>
                    <a href="mailto:{{$tour->tour_manager->email}}" class="text">{{$tour->tour_manager->email}}</a>
                @endif
            </div>
            <div class="spacer-xs"></div>
            @if($tour->tour_manager->viber)
                <div class="contact">
                    <div class="img">
                        <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/viber.svg')}}"
                             alt="viber">
                    </div>
                    <a href="viber:{{clear_phone($tour->tour_manager->viber)}}">{{$tour->tour_manager->viber}}</a>
                </div>
            @endif
            @if($tour->tour_manager->telegram)
                <div class="contact">
                    <div class="img">
                        <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/telegram.svg')}}"
                             alt="viber">
                    </div>
                    <a href="tg://resolve?domain={{clear_phone($tour->tour_manager->telegram)}}">{{$tour->tour_manager->telegram}}</a>
                </div>
            @endif
            @if(!empty($tour->contact))
                <div>
                    {!! $tour->contact !!}
                </div>
            @endif
        </div>
    </div>
@endif
