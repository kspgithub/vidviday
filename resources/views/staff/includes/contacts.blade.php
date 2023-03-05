<div class="accordion-item active">
    <div class="accordion-title">Контакти<i></i></div>
    <div class="accordion-inner px-0" style="display: block;">
        <div class="row">
            @if(!empty($staff->phone))
                <div class="col-lg-4 col-md-6 col-12">
                    <span class="text-md text-medium">Телефонуйте</span>
                    <div class="contact">
                        @foreach($staff->phones as $phone)
                            @if($loop->index > 0)<br>@endif
                            <a href="tel:+{{clear_phone($phone)}}">{{$phone}}</a>
                        @endforeach
                    </div>
                    <div class="spacer-xs only-mobile"></div>
                </div>
            @endif
            <div class="col-lg-4 col-md-6 col-12">
                <span class="text-md text-medium">Пишіть</span>
                @if(!empty($staff->email))
                    <div class="contact">
                        <a href="mailto:{{$staff->email}}">{{$staff->email}}</a>
                    </div>
                @endif
                @if(!empty($staff->skype))
                    <div class="contact">
                        <div class="img">
                            <img loading="lazy" src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/skype.svg')}}"
                                 alt="skype">
                        </div>
                        <a href="skype:{{$staff->skype}}?call">{{$staff->skype}}</a>
                    </div>
                @endif
                @if(!empty($staff->viber))
                    <div class="contact">
                        <div class="img">
                            <img loading="lazy" src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/viber.svg')}}"
                                 alt="viber">
                        </div>
                        <a href="viber:{{$staff->viber}}">{{$staff->viber}}</a>
                    </div>
                @endif
                @if(!empty($staff->whatsapp))
                    <div class="contact">
                        <div class="img">
                            <img loading="lazy" src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/whatsapp.svg')}}"
                                 alt="whatsapp">
                        </div>
                        <a href="https://wa.me/{{clear_phone($staff->whatsapp)}}">{{$staff->whatsapp}}</a>
                    </div>
                @endif
                @if(!empty($staff->telegram))
                    <div class="contact">
                        <div class="img">
                            <img loading="lazy" src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/telegram.svg')}}"
                                 alt="telegram">
                        </div>
                        <a href="https://t.me/{{str_replace('@', '', $staff->telegram)}}">{{'@'.str_replace('@', '', $staff->telegram)}}</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="spacer-xs"></div>
    </div>
</div>
