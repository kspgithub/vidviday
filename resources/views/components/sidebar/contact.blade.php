@props([
    'staff'=> new \App\Models\Staff()
])
<div class="sidebar-item notice">
    <div class="top-part">
        <div class="title h3 light title-icon">
            <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/ring.svg')}}" alt="ring">Контакти
        </div>
    </div>
    <div class="bottom-part">
        <span class="text-md text-medium">{{$staff->name}}</span>
        <br>
        <span class="text-sm">{{$staff->title}}</span>
        <div class="spacer-xs"></div>
        <div>
            @foreach($staff->phones as $phone)
                <a href="tel:{{clear_phone($phone)}}" class="text">{{$phone}}</a>
                @if(!$loop->last)
                    <br>
                @endif
            @endforeach

            @if($staff->email)
                <div class="spacer-xs"></div>
                <a href="mailto:{{$staff->email}}" class="text">{{$staff->email}}</a>
            @endif
        </div>
        @if($staff->avatar)
            <img class="manager-avatar" src="{{asset('/img/preloader.png')}}" data-img-src="{{$staff->avatar_url}}"
                 alt="{{$staff->title}}">
        @endif
    </div>
</div>
