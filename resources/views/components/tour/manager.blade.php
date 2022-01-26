@props([
    'manager'=> new \App\Models\Staff(),
])
@if($manager)
    <div class="sidebar-item notice">
        <div class="top-part">
            <div class="title h3 light title-icon">
                <img src="{{asset('/img/preloader.png')}}"
                     data-img-src="{{asset('/icon/headphones.svg')}}"
                     alt="headphones">
                @lang('tours-section.tour-manager')
            </div>
        </div>
        <div class="bottom-part">
            <span class="text-md text-medium">{{$manager->name}}</span>
            <div class="spacer-xs"></div>
            <div>
                @foreach($manager->phones as $phone)
                    <a href="tel:{{clear_phone($phone)}}" class="text">{{$phone}}</a>
                    <br>
                @endforeach
                @if($manager->email)
                    <div class="spacer-xs"></div>
                    <a href="mailto:{{$manager->email}}" class="text">{{$manager->email}}</a>
                @endif
            </div>
            <div class="spacer-xs"></div>
            @if($manager->viber)
                <div class="contact">
                    <div class="img">
                        <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/viber.svg')}}"
                             alt="viber">
                    </div>
                    <a href="viber:{{clear_phone($manager->viber)}}">{{$manager->viber}}</a>
                </div>
            @endif
            @if($manager->telegram)
                <div class="contact">
                    <div class="img">
                        <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/telegram.svg')}}"
                             alt="viber">
                    </div>
                    <a href="tg://resolve?domain={{clear_phone($manager->telegram)}}">{{$manager->telegram}}</a>
                </div>
            @endif
            @if($manager->whatsapp)
                <div class="contact">
                    <div class="img">
                        <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/whatsapp.svg')}}"
                             alt="whatsapp">
                    </div>
                    <a href="https://wa.me/{{clear_phone($manager->whatsapp, false)}}">{{$manager->whatsapp}}</a>
                </div>
            @endif
            @if(!empty($manager->additional))
                <div>
                    {!! $manager->additional !!}
                </div>
            @endif
            @if(!empty($manager->avatar))
                <img src="{{$manager->avatar_url}}" data-img-src="{{$manager->avatar_url}}"
                     class="manager-avatar"
                     alt="{{$manager->name}}">
            @endif
        </div>
    </div>
@endif
