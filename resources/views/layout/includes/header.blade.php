<header>
    <div class="container">
        <a href="/" id="logo">
            <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/img/logo.png')}}" alt="logo">
        </a>
        <div class="row">
            <div class="col-xl-6 col">
                <div v-is="'header-search'"></div>
            </div>

            <div class="col-xl-6 col-10">
                <div class="tel dropdown">
                    @foreach($contacts as $phone)
                        <a href="tel:{{$phone->work_phone}}" class="only-desktop">{{$phone->work_phone}}</a>
                        <span class="dropdown-btn"></span>
                        <ul class="dropdown-toggle">
                            <li>
                                <a href="tel:{{$phone->phone_1}}">{{$phone->phone_1}}</a>
                            </li>

                            <li>
                                <a href="tel:{{$phone->phone_2}}">{{$phone->phone_2}}</a>
                            </li>

                            <li>
                                <a href="tel:{{$phone->phone_3}}">{{$phone->phone_3}}</a>
                            </li>
                        </ul>
                        <div class="full-size"></div>
                    @endforeach
                </div>

                <span class="vertical-separator"></span>

                @if(Auth::check())
                    <div class="log-in log-inned dropdown">
                        <a href="#favorites" class="log-inned-icon">
                            <span>2</span>
                        </a>
                        <div class="img">
                            <img src="{{asset('/img/preloader.png')}}" data-img-src="{{current_user()->avatar_url}}"
                                 alt="user">
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
                                <a href="#"
                                   onclick="event.preventDefault(); document.getElementById('header-logout-form').submit();">Вихід</a>
                                <form id="header-logout-form" action="{{ route('auth.logout') }}" method="POST"
                                      class="d-none">
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

                <x-header.currency-dropdown class="only-desktop"/>

                <span class="vertical-separator"></span>

                <x-header.lang-dropdown class="only-desktop"/>


                <div id="menu-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div class="col">
                <nav>
                    <div class="only-mobile">

                        <x-header.currency-dropdown/>

                        <span class="vertical-separator"></span>

                        <x-header.lang-dropdown/>

                        <div class="spacer-sm"></div>
                        <hr>
                        <div class="spacer-sm"></div>
                    </div>
                    <ul>
                        <li class="dropdown">
                            <a href="{{pageUrlByKey('about')}}">Чому відвідай</a>
                            <span class="dropdown-btn"></span>
                            <div class="dropdown-toggle">
                                <ul>
                                    <li>
                                        <a href="{{pageUrlByKey('about')}}">Про нас</a>
                                    </li>

                                    <li>
                                        <a href="{{pageUrlByKey('documents')}}">Наші документи</a>
                                    </li>

                                    <li>
                                        <a href="{{pageUrlByKey('guides')}}">Екскурсоводи</a>
                                    </li>

                                    <li>
                                        <a href="{{pageUrlByKey('office-workers')}}">Офісні працівники</a>
                                    </li>

                                    <li>
                                        <a href="{{ route("news") }}">{{ __("Новини") }}</a>
                                    </li>
                                    <li>
                                        <a href="{{pageUrlByKey('benefit')}}">Благодійність</a>
                                    </li>
                                </ul>

                                <ul>
                                    <li>
                                        <a href="{{pageUrlByKey('awards')}}">Нагороди та відзнаки</a>
                                    </li>

                                    <li>
                                        <a href="{{pageUrlByKey('vacancies')}}">Вакансії</a>
                                    </li>

                                    <li>
                                        <a href="{{pageUrlByKey('practice')}}">Практика</a>
                                    </li>

                                    <li>
                                        <a href="{{pageUrlByKey('testimonials')}}">Відгуки</a>
                                    </li>

                                    <li>
                                        <a href="{{ route("blogs") }}">Блог</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="dropdown">
                            <a href="{{pageUrlByKey('tours')}}">Тури</a>
                            <span class="dropdown-btn"></span>
                            <div class="dropdown-toggle">
                                <ul>
                                    @foreach($tourGroups as $tourGroup)
                                        <li>
                                            <a href="{{$tourGroup->url}}">{{$tourGroup->title}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>

                        <li class="only-pad-mobile">
                            <a href="{{pageUrlByKey('order')}}">Замовити тур</a>
                        </li>

                        <li>
                            <a href="{{route('places')}}">Місця</a>
                        </li>

                        <li>
                            <a href="{{route('events')}}">Події</a>
                        </li>

                        <li class="dropdown">
                            <a href="#">Пропозиції</a>
                            <span class="dropdown-btn"></span>
                            <div class="dropdown-toggle">
                                <ul>
                                    <li>
                                        <a href="{{pageUrlByKey('for-travel-agents')}}">Турагентам</a>
                                    </li>

                                    <li>
                                        <a href="{{pageUrlByKey('schools')}}">Школам</a>
                                    </li>

                                    <li>
                                        <a href="{{route('corporates')}}">Корпоративи</a>
                                    </li>

                                    <li>
                                        <a href="{{pageUrlByKey('certificate')}}">Подарунковий сертифікат</a>
                                    </li>

                                    <li>
                                        <a href="{{route('transport')}}">Транспорт</a>
                                    </li>

                                    <li>
                                        <a href="{{pageUrlByKey('guides-courses')}}">Курси екскурсоводів</a>
                                    </li>

                                    <li>
                                        <a href="{{pageUrlByKey('accommodation')}}">Проживанняs</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="/faq">Є питання?</a>
                        </li>

                        <li>
                            <a href="/contacts">Контакти</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
