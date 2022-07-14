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
                    <a href="tel:{{clear_phone($phone)}}" class="text" target="_blank">{{$phone}}</a>
                    <br>
                @endforeach
                @if($manager->email)
                    <div class="spacer-xs"></div>
                    <a href="mailto:{{$manager->email}}" class="text" target="_blank">{{$manager->email}}</a>
                @endif
            </div>
            <div class="spacer-xs"></div>
            @if($manager->viber)
                <div class="contact">
                    <div class="img">{{svg('viber')}}</div>
                    <a href="{{viber_link($manager->viber)}}" target="_blank">{{$manager->viber}}</a>
                </div>
            @endif
            @if($manager->telegram)
                <div class="contact">
                    <div class="img">
                        {{svg('telegram')}}
                    </div>
                    <a href="{{tg_link($manager->telegram)}}"
                       target="_blank">{{$manager->telegram}}</a>
                </div>
            @endif
            @if($manager->whatsapp)
                <div class="contact">
                    <div class="img">
                        {{svg('whatsapp')}}
                    </div>
                    <a href="{{whatsapp_link($manager->whatsapp)}}"
                       target="_blank">{{$manager->whatsapp}}</a>
                </div>
            @endif
            @if(!empty($manager->additional))
                <div>
                    {!! $manager->additional !!}
                </div>
            @endif
            @if(!empty($manager->avatar))
                <img src="{{$manager->avatar_url}}" data-img-src="{{$manager->avatar_url}}"
                     alt="{{$manager->name}}">
            @endif
        </div>
    </div>
@endif
