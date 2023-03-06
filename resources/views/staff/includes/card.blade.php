<div class="img img-border img-caption style-2">
    @if($specialist->label)
        <div class="top-part text-center">
            <span class="h3 light text-bold">{{$specialist->label}}</span>
        </div>
    @endif
    <div class="zoom centered">
        <img loading="lazy" src="{{asset('img/preloader.png')}}"
             data-src="{{ $specialist->avatar_url ?? asset('img/no-image.png') }}"
             alt="{{$specialist->first_name}} {{$specialist->last_name}}">
        <a href="{{ $specialist->url }}" class="full-size"></a>
    </div>
    <div class="img-caption-info">
        <div class="guide-name">
            <span class="h3">
                <a href="{{ $specialist->url}}">{{$specialist->first_name}} {{$specialist->last_name}}</a>
            </span>
            <div class="text">{{$specialist->testimonials_count}} відгуків</div>
            <div class="text">{{$specialist->position}}</div>
        </div>
        <hr>
        @if(!empty($specialist->phone))
            <div class="contact">
                @foreach($specialist->phones as $phone)
                    @if($loop->index > 0)<br>@endif
                    <a href="tel:+{{clear_phone($phone)}}">{{$phone}}</a>
                @endforeach
            </div>
        @endif
        @if(!empty($specialist->email))
            <div class="contact">
                <a href="mailto:{{$specialist->email}}">{{$specialist->email}}</a>
            </div>
        @endif
        @if(!empty($specialist->skype))
            <div class="contact">
                <div class="img">
                    <img loading="lazy" src="{{asset('img/preloader.png')}}" data-src="{{asset('icon/skype.svg')}}" alt="skype">
                </div>
                <a href="skype:{{$specialist->skype}}?call">{{$specialist->skype}}</a>
            </div>
        @endif
        @if(!empty($specialist->viber))
            <div class="contact">
                <div class="img">
                    <img loading="lazy" src="{{asset('img/preloader.png')}}" data-src="{{asset('icon/viber.svg')}}" alt="viber">
                </div>
                <a href="viber:{{$specialist->viber}}">{{$specialist->viber}}</a>
            </div>
        @endif
        @if(!empty($specialist->whatsapp))
            <div class="contact">
                <div class="img">
                    <img loading="lazy" src="{{asset('img/preloader.png')}}" data-src="{{asset('icon/whatsapp.svg')}}"
                         alt="whatsapp">
                </div>
                <a href="https://wa.me/{{clear_phone($specialist->whatsapp)}}">{{$specialist->whatsapp}}</a>
            </div>
        @endif
        @if(!empty($specialist->telegram))
            <div class="contact">
                <div class="img">
                    <img loading="lazy" src="{{asset('img/preloader.png')}}" data-src="{{asset('icon/telegram.svg')}}"
                         alt="telegram">
                </div>
                <a href="https://t.me/{{str_replace('@', '', $specialist->telegram)}}">{{'@'.str_replace('@', '', $specialist->telegram)}}</a>
            </div>
        @endif
        <div class="spacer-xs"></div>
        <x-seo-button :code="'goto.staff'" href="{{ $specialist->url}}" class="btn type-1 btn-block">Дізнатись більше</x-seo-button>
    </div>
</div>
