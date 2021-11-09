<div class="left-sidebar">

    <div class="left-sidebar-inner">

        <a href="{{route('order.index')}}" class="btn type-4 arrow-right only-desktop">
            {{svg('sidebar-tour')}} Замовити тур</a>

        <a href="{{asset('documents/test-document.pdf')}}" download class="btn type-5 arrow-right only-desktop">
            {{svg('excel')}} Завантажити розклади турів</a>

        <x-sidebar.filter/>

        <div class="spacer-xl only-mobile"></div>

        <div class="sidebar-item notice">
            <div class="top-part">
                <div class="h3 light title-icon">
                    <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/info.svg')}}" alt="info">
                    Оголошення
                </div>
            </div>
            <div class="bottom-part">
                <div class="text">
                    <p>В карточці туру ви можете дізнатись вільні дати, тривалість туру, а також потрібну кількість
                        людей.</p>
                </div>
                <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/img/advertation.jpg')}}"
                     alt="advert">
            </div>
        </div>

        <div class="sidebar-item overflow-hidden no-border">
            <div class="gift-certificate">
                <div class="bg" data-bg-src="{{asset('/img/gift-certificate.jpg')}}"
                     style="background-image: url('{{asset('/img/preloader.png')}}');"></div>
                <div class="gift-icon">
                    <img src="{{asset('/icon/gift.svg')}}" alt="gift">
                </div>
                <div class="title h3 light">Подарунковий<br> сертифікат</div>
                <a href="#" class="full-size"></a>
            </div>
        </div>
        <x-sidebar.latest-news/>
        <x-sidebar.latest-testimonials/>

        <x-sidebar.mailing/>

    </div>

</div>
