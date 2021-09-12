<div class="left-sidebar">

    <div class="left-sidebar-inner">
        <span class="btn type-4 arrow-right only-desktop">{{svg('sidebar-tour')}} Замовити тур</span>

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

        <div class="sidebar-item only-desktop">
            <div class="top-part b-border">
                <div class="title h3 title-icon">
                    <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/mailing.svg')}}"
                         alt="mailing">
                    <span>{{ __("Новини") }}</span>
                </div>
            </div>
            <div class="bottom-part">
                <div class="news-links">

                    @foreach(latestNews() as $post)

                        <div class="news-item">
                            <a href="{{ route("news.single", ["slug" => $post->slug]) }}" class="title">{{ $post->title }}</a>
                            <div class="news-date">{{ $post->created_at->format("d.m.Y") }}</div>
                        </div>

                    @endforeach

                </div>
                <a href="{{ route("news") }}" class="btn type-2">{{ __("Показати всі новини") }}</a>
            </div>
        </div>

        <div class="sidebar-item">
            <div class="top-part b-border">
                <div class="title h3 title-icon">
                    <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/reviews.svg')}}"
                         alt="reviews">
                    <span>Відгуки</span>
                </div>
            </div>
            <div class="bottom-part">
                <div class="review">
                    <div class="review-header">
                        <div class="review-img">
                            <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/img/user.jpg')}}"
                                 alt="user">
                        </div>
                        <div class="review-title">
                            <span class="h4">Григоряш Вероніка</span>
                            <span class="text text-sm">22.11.2019</span>
                            <span class="text text-sm">22:10</span>
                            <span class="stars select-stars stars-selected">
							<i class="select-icon icon-star"></i>
							<i class="select-icon icon-star"></i>
							<i class="select-icon icon-star"></i>
							<i class="select-icon icon-star"></i>
							<i class="select-icon icon-star-empty"></i>
						</span>
                        </div>
                    </div>
                    <div class="text">
                        <p>Тур: <a href="#">Сиро-Винний тур Закарпатським та Прикарпатськими замками</a></p>
                        <p>Чудовий тур! Отлимала безліч вражень, обов’язково спробую ще!</p>
                    </div>
                </div>

                <div class="review">
                    <div class="review-header">
                        <div class="review-img">
                            <span class="h4 full-size">КП</span>
                        </div>
                        <div class="review-title">
                            <span class="h4">Корнієнко Петро</span>
                            <span class="text text-sm">22.11.2019</span>
                            <span class="text text-sm">14:09</span>
                            <span class="stars select-stars stars-selected">
							<i class="select-icon icon-star"></i>
							<i class="select-icon icon-star"></i>
							<i class="select-icon icon-star"></i>
							<i class="select-icon icon-star"></i>
							<i class="select-icon icon-star-empty"></i>
						</span>
                        </div>
                    </div>
                    <div class="text">
                        <p>Тур: <a href="#">10 родзинок Закарпаття</a></p>
                        <p>Від туру залишились тільки позитивні емоції. Дякую організаторам!</p>
                    </div>
                </div>
                <a href="#" class="btn type-2 btn-block">Показати всі відгуки</a>
            </div>
        </div>

        <div class="sidebar-item">
            <div class="top-part b-border">
                <div class="title h3 title-icon">
                    <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/email.svg')}}"
                         alt="mailing">
                    <span>Розсилка</span>
                </div>
            </div>
            <div class="bottom-part">
                <div class="subscribe-block">
                    <span class="btn type-2 open-popup" data-rel="tourists-mailing-popup">Я — турист</span>
                    <span class="btn type-2 open-popup" data-rel="agents-mailing-popup">Я — турагент</span>
                </div>
            </div>
        </div>
    </div>

</div>
