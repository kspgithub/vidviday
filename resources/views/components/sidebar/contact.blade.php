@props([
    'staff'=> new \App\Models\Staff()
])
<div class="sidebar-item notice">
    <div class="top-part">
        <div class="title h3 light title-icon">
            <img loading="lazy" data-src="/icon/ring.svg" data-src="/icon/ring.svg" alt="ring">
            {{ __('footer-section.contacts') }}
        </div>
    </div>
    <div class="bottom-part">
        <span class="text-md text-medium">{{$staff->name}}</span>
        <div class="spacer-xs"></div>
        <div class="contact">
            @foreach($staff->phones as $phone)
                <a href="tel:{{clear_phone($phone)}}" class="text" target="_blank">{{$phone}}</a>
                <br>
            @endforeach
            @if($staff->email)
                <div class="spacer-xs"></div>
                <a href="mailto:{{$staff->email}}" class="text" target="_blank">{{$staff->email}}</a>
            @endif
        </div>
        @if($staff->viber)
            <div class="contact">
                <div class="img">{{svg('viber')}}</div>
                <a href="{{viber_link($staff->viber)}}" target="_blank">{{$staff->viber}}</a>
            </div>
        @endif
        @if($staff->telegram)
            <div class="contact">
                <div class="img">
                    {{svg('telegram')}}
                </div>
                <a href="{{tg_link($staff->telegram)}}"
                   target="_blank">{{$staff->telegram}}</a>
            </div>
        @endif
        @if($staff->whatsapp)
            <div class="contact">
                <div class="img">
                    {{svg('whatsapp')}}
                </div>
                <a href="{{whatsapp_link($staff->whatsapp)}}"
                   target="_blank">{{$staff->whatsapp}}</a>
            </div>
        @endif
        @if(!empty($staff->additional))
            <div>
                {!! $staff->additional !!}
            </div>
        @endif
        @if(!empty($staff->avatar))
            <img loading="lazy" class="manager-avatar"
                 src="{{$staff->avatar_url}}" data-src="{{$staff->avatar_url}}"
                 alt="{{$staff->name}}">
        @endif
    </div>
</div>
