@props([
    'tour'=> new \App\Models\Tour(),
])

<div class="sidebar-item notice">
    <div class="top-part">
        <div class="title h3 light title-icon">
            <img src="{{asset('/img/preloader.png')}}"
                 data-img-src="{{asset('/icon/headphones.svg')}}"
                 alt="headphones">Менеджер туру
        </div>
    </div>
    <div class="bottom-part">
        <span class="text-md text-medium">Кишенюк Василина</span>
        <div class="spacer-xs"></div>
        <div>
            <a href="tel:+380978450651" class="text">+38 (097) 845 06 51</a>
            <br>
            <a href="tel:+380635064349" class="text">+38 (063) 506 43 49</a>
            <div class="spacer-xs"></div>
            <a href="mailto:vidviday.vasylyna@gmail.com" class="text">vidviday.vasylyna@gmail.com</a>
        </div>
        <div class="spacer-xs"></div>
        <div class="contact">
            <div class="img">
                <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/viber.svg')}}"
                     alt="viber">
            </div>
            <a href="viber:+380935115622">+38 (093) 511 56 22</a>
        </div>
        <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/img/manager.png')}}" alt="manager">
    </div>
</div>
