<div class="right-sidebar">
    <div class="right-sidebar-inner">
        <div class="bordered-box only-desktop-pad">
            <a href="{{ asset("document/document.pdf") }}" download class="download">
                <span class="text-md text-medium">{{ __("Завантажити для друку") }}</span>
            </a>
            <hr>
            <x-sidebar.social-share :share-url="route('page.show', $pageContent->slug)" :share-title="$pageContent->title"/>
        </div>
        <div class="spacer-xs only-pad-mobile"></div>

        <div class="sidebar-item notice">

            <div class="top-part">
                <div class="title h3 light title-icon"><img src="{{ asset("img/preloader.png") }}" data-img-src="{{ asset("icon/ring.svg") }}" alt="ring">{{ __("Контакти") }}</div>
            </div>
            <div class="bottom-part">
                <span class="text-md text-medium">Христина Чорній</span>
                <br>
                <span class="text-sm">{{ __("спеціаліст з бронювання та керівник екскурсійних груп") }}</span>
                <div class="spacer-xs"></div>
                <div>
                    <a href="tel:+380978450651" class="text">+38-(032)-255-36-55</a>
                    <br>
                    <a href="tel:+380635064349" class="text">+38-(096)-481-36-70</a>
                    <br>
                    <a href="tel:+380932533837" class="text">+38-(093)-253-38-37</a>
                    <br>
                    <a href="tel:+380668259936" class="text">+38-(066)-825-99-36</a>
                    <div class="spacer-xs"></div>
                    <a href="mailto:vidviday.vasylyna@gmail.com" class="text">vidviday.vasylyna@gmail.com</a>
                </div>
                <img src="{{ asset("img/preloader.png") }}" data-img-src="img/transport-manager.png" alt="transport manager">
            </div>
        </div>

        <div class="sidebar-item testimonials">
            <div class="top-part b-border">
                <div class="title h3 title-icon">
                    <img src="{{ asset("img/preloader.png") }}" data-img-src="{{ asset("icon/reviews.svg") }}" alt="reviews">
                    <span>{{ __("Нас рекомендують") }}</span>
                </div>
            </div>
            <div class="bottom-part">
                <div class="only-desktop">
                    <div class="review">
                        <div class="review-header">
                            <div class="review-img">
                                <img src="{{ asset("img/preloader.png") }}" data-img-src="{{ asset("img/user.jpg") }}" alt="user">
                            </div>
                            <div class="review-title">
                                <span class="h4">Тетяна Вілсон</span>
                                <span class="text text-sm">туроператор «Піраміда Тур»</span>
                            </div>
                        </div>
                        <div class="text">
                            <p>Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років...</p>
                        </div>
                    </div>
                    <div class="seo-text load-more-wrapp">
                        <div class="more-info">
                            <div class="text">
                                <p>Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років. Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років. Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років.</p>
                                <p>Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років. Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років. Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років.</p>
                            </div>
                            <div class="spacer-xs"></div>
                        </div>
                        <div class="show-more">
                            <span>Читати більше</span>
                            <span>Сховати текст</span>
                        </div>
                    </div>
                    <div class="spacer-xs"></div>


                </div>

                <div class="only-pad-mobile">
                    <div class="swiper-entry">
                        <div class="swiper-button-prev inner bottom-2 only-mobile">
                            <i></i>
                        </div>
                        <div class="swiper-button-next inner bottom-2 only-mobile">
                            <i></i>
                        </div>
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="review">
                                        <div class="review-header">
                                            <div class="review-img">
                                                <img src="img/preloader.png" data-img-src="img/user.jpg" alt="user">
                                            </div>
                                            <div class="review-title">
                                                <span class="h4">Тетяна Вілсон</span>
                                                <span class="text text-sm">туроператор «Піраміда Тур»</span>
                                            </div>
                                        </div>
                                        <div class="text">
                                            <p>Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років...</p>
                                        </div>
                                    </div>
                                    <div class="seo-text load-more-wrapp">
                                        <div class="more-info">
                                            <div class="text">
                                                <p>Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років. Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років. Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років.</p>
                                                <p>Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років. Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років. Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років.</p>
                                            </div>
                                            <div class="spacer-xs"></div>
                                        </div>
                                        <div class="show-more">
                                            <span>Читати більше</span>
                                            <span>Сховати текст</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="review">
                                        <div class="review-header">
                                            <div class="review-img">
                                                <img src="img/preloader.png" data-img-src="img/user.jpg" alt="user">
                                            </div>
                                            <div class="review-title">
                                                <span class="h4">Тетяна Вілсон</span>
                                                <span class="text text-sm">туроператор «Піраміда Тур»</span>
                                            </div>
                                        </div>
                                        <div class="text">
                                            <p>Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років...</p>
                                        </div>
                                    </div>
                                    <div class="seo-text load-more-wrapp">
                                        <div class="more-info">
                                            <div class="text">
                                                <p>Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років. Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років. Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років.</p>
                                                <p>Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років. Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років. Наше агентство "Піраміда-тур" співпрацює з операторам "Відвідай" впродовж 3 років.</p>
                                            </div>
                                            <div class="spacer-xs"></div>
                                        </div>
                                        <div class="show-more">
                                            <span>Читати більше</span>
                                            <span>Сховати текст</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination relative"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
