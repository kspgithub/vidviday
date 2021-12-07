<header>
    <div class="container">
        <a href="/" id="logo">
            <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/img/logo.png')}}" alt="Vidviay">
        </a>
        <div class="row hidden-print">
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
                        <a href="{{route('profile.favourites')}}" class="log-inned-icon">
                            <span v-is="'profile-in-favourites'"></span>
                        </a>
                        <div class="img">
                            <img src="{{asset('/img/preloader.png')}}" data-img-src="{{current_user()->avatar_url}}"
                                 alt="user">
                        </div>
                        <span class="dropdown-btn"></span>
                        <ul class="dropdown-toggle">
                            @if(current_user()->isAdmin())
                                <li>
                                    <a href="{{route('admin.dashboard')}}">{{__('header-section.administration')}}</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{route('profile.index')}}">{{__('header-section.personal-data')}}</a>
                            </li>

                            <li>
                                <a href="{{route('profile.orders')}}">{{__('header-section.order-history')}}</a>
                            </li>

                            <li>
                                <a href="{{route('profile.history')}}">{{__('header-section.browsing-history')}}</a>
                            </li>

                            <li>
                                <a href="{{route('profile.favourites')}}"
                                   v-is="'profile-favourite-link'">{{__('header-section.favorites')}}</a>
                            </li>

                            <li>
                                <a href="#">{{__('header-section.info-letters')}}</a>
                            </li>

                            <li>
                                <a href="#"
                                   onclick="event.preventDefault(); document.getElementById('header-logout-form').submit();">{{__('header-section.logout')}}</a>
                                <form id="header-logout-form" action="{{ route('auth.logout') }}" method="POST"
                                      class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                        <div class="full-size"></div>
                    </div>
                @else
                    <span class="log-in open-popup" data-rel="login-popup">{{__('header-section.login')}}</span>
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
                        @foreach($menu->items as $menuItem)
                            @if($menuItem->children->count() > 0)
                                <li class="dropdown {{$menuItem->class_name ?? ''}}">
                                    <a href="{{$menuItem->slug}}" class="dropdown-title">{{$menuItem->title}}</a>
                                    <span class="dropdown-btn"></span>
                                    <div class="dropdown-toggle">
                                        @if($menuItem->children->where('side', '=', 'left')->count() > 0 )
                                            <ul>
                                                @foreach($menuItem->children->where('side', '=', 'left') as $menuChildren)
                                                    <li class="{{$menuChildren->class_name ?? ''}}">
                                                        <a href="{{$menuChildren->slug}}">{{$menuChildren->title}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        @if($menuItem->children->where('side', '=', 'right')->count() > 0 )
                                            <ul>
                                                @foreach($menuItem->children->where('side', '=', 'right') as $menuChildren)
                                                    <li class="{{$menuChildren->class_name ?? ''}}">
                                                        <a href="{{$menuChildren->slug}}">{{$menuChildren->title}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </li>
                            @else
                                <li class="{{$menuItem->class_name ?? ''}}">
                                    <a href="{{$menuItem->slug}}">{{$menuItem->title}}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
