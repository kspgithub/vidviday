@props([
    'title'=>'',
    'staff'=> new \App\Models\Staff()
])
@if(!empty($staff))
    <h3 class="h3">{{$title}}, {{$staff->name}}:</h3>
    <div class="spacer-xs"></div>
    @if(!empty($staff->email))
        <div class="contact">
            <div class="img">
                <img loading="lazy" src="/img/preloader.png" data-src="/icon/mail.svg" alt="mail">
            </div>
            <a href="mailto:vidviday.transport@gmail.com">{{$staff->email}}</a>
        </div>
    @endif
    @if(!empty($staff->phones))
        <div class="contact">
            <div class="img">
                <img loading="lazy" src="/img/preloader.png" data-src="/icon/smartphone.svg" alt="smartphone">
            </div>
            @foreach($staff->phones as $phone)
                <a href="tel:{{clear_phone($phone)}}">{{$phone}}</a>
                @if(!$loop->last)
                    <br>
                @endif
            @endforeach

        </div>
    @endif
    @if(!empty($staff->viber))
        <div class="contact">
            <div class="img">
                <img loading="lazy" src="/img/preloader.png" data-src="/icon/viber.svg" alt="viber">
            </div>
            <a title="Встановіть Viber для ПК"
               href="viber://chat?number={{clear_phone($staff->viber)}}">{{$staff->viber}}</a>
        </div>
    @endif
    <div class="spacer-sm"></div>
@endif

