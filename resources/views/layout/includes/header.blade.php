<header>
    <div class="container">
        <a href="/" id="logo">
            <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/img/logo.png')}}" alt="logo">
        </a>
        <div class="row">
            <div class="col-xl-6 col">
                <form action="/" class="header-search">
                    <input type="text" name="search" placeholder="Знайти тур..." class="input-search">
                    <div class="search-toggle">
                        <ul>
                            <li>
                                <div class="img">
                                    <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/img/preview_1.jpg')}}" alt="img">
                                </div>
                                <span class="text">Сиро-Винний тур Закарпаттям</span>
                            </li>

                            <li>
                                <div class="img">
                                    <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/img/preview_2.jpg')}}" alt="img">
                                </div>
                                <span class="text">10 родзинок Закарпаття</span>
                            </li>

                            <li>
                                <div class="img">
                                    <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/img/preview_3.jpg')}}" alt="img">
                                </div>
                                <span class="text">Різдво у Карпатах</span>
                            </li>

                            <li>
                                <div class="img">
                                    <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/img/preview_4.jpg')}}" alt="img">
                                </div>
                                <span class="text">Озера Карпат</span>
                            </li>

                            <li>
                                <div class="img">
                                    <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/img/preview_5.jpg')}}" alt="img">
                                </div>
                                <span class="text">Несамовите озеро в Карпатах</span>
                            </li>
                        </ul>
                        <div class="search-toggle-footer">
                            <span class="text">Всі результати пошуку</span>
                        </div>
                    </div>
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18px" height="17.999px" viewBox="0 0 18 17.999"><path d="M8 2c3.308 0 6 2.692 6 6s-2.692 6-6 6-6-2.692-6-6 2.692-6 6-6m0-2C3.582 0 0 3.582 0 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8z"/><path d="M14 12.999l-1 1 4 4 1-1-4-4z"/></svg>
                    </button>
                    <div class="voice-search-btn open-popup only-desktop" data-rel="voice-search-popup">
                        <svg width="12" height="18" viewBox="0 0 12 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 1c-.569 0-1.114.23-1.515.64-.402.41-.628.966-.628 1.546v5.828c0 .58.226 1.136.628 1.546.401.41.946.64 1.515.64.568 0 1.113-.23 1.515-.64.402-.41.628-.966.628-1.546V3.186c0-.58-.226-1.136-.628-1.546A2.122 2.122 0 006 1v0z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11 7.522v1.47a5.228 5.228 0 01-1.464 3.642A4.928 4.928 0 016 14.142a4.928 4.928 0 01-3.536-1.508A5.228 5.228 0 011 8.993V7.522M6 14.571v2.01M3.143 17h5.714" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <span class="vertical-separator"></span>
                    <div id="search-btn" class="full-size"></div>
                    <div class="btn-close">
                        <span></span>
                    </div>
                </form>
            </div>

            <div class="col-xl-6 col-10">
                <div class="tel dropdown">
                    <a href="tel:+380322553655" class="only-desktop">+38 (032) 255 36 55</a>
                    <span class="dropdown-btn"></span>
                    <ul class="dropdown-toggle">
                        <li>
                            <a href="tel:+380322553655">+38 (032) 255 36 55</a>
                        </li>

                        <li>
                            <a href="tel:+380322553655">+38 (032) 255 36 55</a>
                        </li>

                        <li>
                            <a href="tel:+380322553655">+38 (032) 255 36 55</a>
                        </li>
                    </ul>
                    <div class="full-size"></div>
                </div>

                <span class="vertical-separator"></span>

                @if(Auth::check())
                    <div class="log-in log-inned dropdown">
                        <a href="#favorites" class="log-inned-icon">
                            <span>2</span>
                        </a>
                        <div class="img">
                            <img src="{{asset('/img/preloader.png')}}" data-img-src="{{current_user()->avatar_url}}" alt="user">
                        </div>
                        <span class="dropdown-btn"></span>
                        <ul class="dropdown-toggle">
                            @if(current_user()->isAdmin())
                                <li>
                                    <a href="{{route('admin.dashboard')}}">Адміністрування</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{route('profile.index')}}">Особисті дані</a>
                            </li>

                            <li>
                                <a href="{{route('profile.orders')}}">Історія замовлень</a>
                            </li>

                            <li>
                                <a href="{{route('profile.history')}}">Історія переглядів</a>
                            </li>

                            <li>
                                <a href="{{route('profile.favourites')}}">Улюблені <span>2</span></a>
                            </li>

                            <li>
                                <a href="#">Інфо листи</a>
                            </li>

                            <li>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('header-logout-form').submit();">Вихід</a>
                                <form id="header-logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                        <div class="full-size"></div>
                    </div>
                @else
                    <span class="log-in open-popup" data-rel="login-popup">Вхід</span>
                @endif


                <span class="vertical-separator"></span>

                <x-header.currency-dropdown class="only-desktop" />

                <span class="vertical-separator"></span>

                <x-header.lang-dropdown class="only-desktop" />


                <div id="menu-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div class="col">
                <nav>
                    <div class="only-mobile">

                        <x-header.currency-dropdown />

                        <span class="vertical-separator"></span>

                        <x-header.lang-dropdown />

                        <div class="spacer-sm"></div>
                        <hr>
                        <div class="spacer-sm"></div>
                    </div>
                    <ul>
                        <li class="dropdown">
                            <a href="#">Чому відвідай</a>
                            <span class="dropdown-btn"></span>
                            <div class="dropdown-toggle">
                                <ul>
                                    <li>
                                        <a href="#">Про нас</a>
                                    </li>

                                    <li>
                                        <a href="/documents/">Наші документи</a>
                                    </li>

                                    <li>
                                        <a href="/cuides/">Екскурсоводи</a>
                                    </li>

                                    <li>
                                        <a href="/office-workers/">Офісні працівники</a>
                                    </li>

                                    <li>
                                        <a href="/news/">Новини</a>
                                    </li>

                                    <li>
                                        <a href="/benefit/">Благодійність</a>
                                    </li>
                                </ul>

                                <ul>
                                    <li>
                                        <a href="/awards/">Нагороди та відзнаки</a>
                                    </li>

                                    <li>
                                        <a href="/vacancies/">Вакансії</a>
                                    </li>

                                    <li>
                                        <a href="/practice/">Практика</a>
                                    </li>

                                    <li>
                                        <a href="/testimonials/">Відгуки</a>
                                    </li>

                                    <li>
                                        <a href="{{ route("blog") }}">Блог</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="dropdown">
                            <a href="tours.php">Тури</a>
                            <span class="dropdown-btn"></span>
                            <div class="dropdown-toggle">
                                <ul>
                                    @foreach($tourGroups as $tourGroup)
                                    <li>
                                        <a href="{{route('tour.index', $tourGroup->slug)}}">{{$tourGroup->title}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>

                        <li class="only-pad-mobile">
                            <a href="order-client-1.php" >Замовити тур</a>
                        </li>

                        <li>
                            <a href="places.php">Місця</a>
                        </li>

                        <li>
                            <a href="events.php">Події</a>
                        </li>

                        <li class="dropdown">
                            <a href="#">Пропозиції</a>
                            <span class="dropdown-btn"></span>
                            <div class="dropdown-toggle">
                                <ul>
                                    <li>
                                        <a href="#">Турагентам</a>
                                    </li>

                                    <li>
                                        <a href="#">Школам</a>
                                    </li>

                                    <li>
                                        <a href="corporates.php">Корпоративи</a>
                                    </li>

                                    <li>
                                        <a href="certificate.php">Подарунковий сертифікат</a>
                                    </li>

                                    <li>
                                        <a href="transport.php">Транспорт</a>
                                    </li>

                                    <li>
                                        <a href="#">Курси екскурсоводів</a>
                                    </li>

                                    <li>
                                        <a href="#">Проживанняs</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="faq.php">Є питання?</a>
                        </li>

                        <li>
                            <a href="contacts.php">Контакти</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
